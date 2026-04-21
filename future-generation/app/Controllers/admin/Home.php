<?php

namespace App\Controllers\admin;

use CodeIgniter\Controller;
use Google\Client;
use Google\Service\Oauth2;
use App\Controllers\BaseController;
use App\Models\ApplicationModel;
use App\Models\HomeModel;
use App\Models\UsersModel;
use App\Models\SendmailModel;


class Home extends BaseController
{
    protected $applicationModel;
    protected $homeModel;
    protected $usersModel;
    protected $session;
    protected $pager;

    public function __construct()
    {
        helper('function'); // Load custom helper
        $this->applicationModel = new ApplicationModel();
         $this->homeModel = new HomeModel();
         $this->usersModel = new UsersModel();
         $this->session = \Config\Services::session();
         $this->pager = \Config\Services::pager(); // CI4 pagination
    }

    public function index()
    {
        //admin_session_loginpage();
        /*$this->load->view('templates/front_header');
		$this->load->view('backend/login_view');
		$this->load->view('templates/front_footer');*/
        return view('backend/login_new');
    }

    public function new_login()
    {
        return view('templates/front_header');
        return view('backend/login_view');
        return view('templates/front_footer');
    }

    public function googleLogin()
    {
        $clientID = '733129836322-t40vgr887cejd5pj91m2rm2hgkukb450.apps.googleusercontent.com';
        $clientSecret = 'JZCen_u5BC4Q4g8tO05qg0-s';
        $redirectUri = base_url('login/googleLogin');

        $gClient = new Client(); // ✅ Correct instantiation
        $gClient->setClientId($clientID);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUri);
        $gClient->addScope('email');
        $gClient->addScope('profile');

        $session = session();

        // When Google redirects back
        if ($this->request->getGet('code')) {
            $token = $gClient->fetchAccessTokenWithAuthCode($this->request->getGet('code'));

            if (!isset($token['access_token'])) {
                return redirect()->to(base_url('login'))->with('error', 'Failed to authenticate.');
            }

            $gClient->setAccessToken($token['access_token']);

            $oauth2 = new Oauth2($gClient); // ✅ Correct class
            $userData = $oauth2->userinfo->get();

            // Save user info or check if exists in DB
            $model = new HomeModel();
            $result = $model->gmailLogin((array) $userData);

            if (isset($result[0]['RES']) && $result[0]['RES'] === 'false') {
                $session->setFlashdata('gmail_msg', 'Email not matched');
                return redirect()->to(base_url('admin/Home'));
            }

            // Set session data
            $session->set([
                'role' => $result[0]['role'],
                'admin_email' => $result[0]['admin_email'],
                'admin_fullname' => $result[0]['admin_fullname'],
                'NAME_ID' => $result[0]['admin_id'],
                'USER_ID' => $result[0]['user_id'],
                'user_type' => 'A',
                'profile_image' => $result[0]['profile_image'],
                'facultystaff' => $result[0]['facultystaff']
            ]);

            // Log login (optional)
            $login_log = [
                'PQUERY_TYPE' => 'INSERT',
                'PUSERID' => $userData->email,
                'PUSER_IP' => $_SERVER['REMOTE_ADDR'],
                'PUSER_BROWSER' => $_SERVER['HTTP_USER_AGENT'],
                'PLOGIN_STATUS' => 'Success'
            ];
            // Call your logging function here, e.g., $this->LogModel->insertLog($login_log);

            // Redirect after login
            $disp_result = $model->get_display_url($result[0]['admin_email']);
            if (!empty($disp_result)) {
                return redirect()->to($disp_result['display_url']);
            } else {
                return redirect()->to(base_url('admin/Form/ViewAppList'));
            }
        }

        // First-time login, redirect to Google
        $authUrl = $gClient->createAuthUrl();
        return redirect()->to($authUrl);
    }

    public function addAdminLoginLog(array $login_log)
    {
        $model = new HomeModel();
        $model->insertLoginAdminLog($login_log);
        return true;
    }

    /**
     * Redirect to Google Drive OAuth consent screen.
     */
    public function access_drive()
    {
        return redirect()->to("https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=offline&client_id=905553062704-ebu07cgl075bikf8f710ohanad6ccjlt.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fstaging.apps.future.edu%2Flogin%2Fgive_access&state&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.file&prompt=select_account%20consent");
    }

    /**
     * Load Google Drive access confirmation view.
     */
    public function give_access()
    {
        echo view('templates/front_header');
        echo view('backend/give_access');
        echo view('templates/front_footer');
    }

    public function login()
    {
        //admin_session_loginpage();
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $homeModel = new HomeModel();
        $session = session();

        $rules = [
            'email'    => 'required',
            'password' => 'required',
        ];

        $validation->setRules($rules);

        // check email id in admin_login table whether it is exists or not
        $email_notexist = $homeModel->email_valid($this->request->getPost('email'));

        if ($email_notexist) {
            session()->setFlashdata('msg', '<div class="alert alert-danger text-center">User Email Not Created. Please contact administrator</div>');
            $login_log['PQUERY_TYPE'] = 'INSERT';
            $login_log['PUSERID'] = $this->request->getPost('email');
            $login_log['PUSER_IP'] = $_SERVER['REMOTE_ADDR'];
            $login_log['PUSER_BROWSER'] = $_SERVER['HTTP_USER_AGENT'];
            $login_log['PLOGIN_STATUS'] = "Fail-User Not in admin_login";
            $this->addAdminLoginLog($login_log);
            return redirect()->to("admin/Home");
            exit;
        }

        $login_log['PQUERY_TYPE'] = 'INSERT';
        $login_log['PUSERID'] = $request->getPost('email');
        $login_log['PUSER_IP'] = $_SERVER['REMOTE_ADDR'];
        $login_log['PUSER_BROWSER'] = $_SERVER['HTTP_USER_AGENT'];

        if (! $validation->withRequest($this->request)->run()) {
            session()->setFlashdata('msg', '<div class="alert alert-danger text-center">' . $validation->listErrors() . '</div>');
            $login_log['PLOGIN_STATUS'] = "Fail-validation error";
            $this->addAdminLoginLog($login_log);
            return redirect()->to("admin/Home");
        } else {

            $attempt_count = session()->get('attempt_count') ?? 0;
            // Check captcha only if attempts >= 1
            if ($attempt_count >= 1) {
                $enteredCaptcha  = strtolower(trim($this->request->getPost('captcha')));
                $sessionCaptcha  = strtolower(trim(session()->get('captchaword')));

                if ($enteredCaptcha !== $sessionCaptcha) {
                    session()->setFlashdata('msg', '<div class="alert alert-danger text-center">Captcha not matched!</div>');
                    $login_log['PLOGIN_STATUS'] = "Fail - Captcha Mismatch";
                    $this->addAdminLoginLog($login_log);
                    return redirect()->to("admin/Home");
                }
            }

            // Proceed to check credentials
               $hashValidation = $this->homeModel->getRegPwdByRegID(
                $this->request->getPost('email'),
                $this->request->getPost('password')
            );

            if ($hashValidation['status'] === false) {
                $errors = $hashValidation['message'];
                session()->setFlashdata('msg', '<div class="alert alert-danger text-center">Oops! ' . $errors . ' Please try again later.</div>');

                $login_log['PLOGIN_STATUS'] = "Invalid Password error";

                // Increment attempt count and enable captcha from next time
                session()->set('attempt_count', $attempt_count + 1);
                if (($attempt_count + 1) >= 1) {
                    session()->set('showCaptcha', true);
                }

                $this->addAdminLoginLog($login_log);
                return redirect()->to("admin/Home");
            }

            // Login successful
            $login_log['PLOGIN_STATUS'] = "Success";
            $this->addAdminLoginLog($login_log);

            // Clear login-specific session items
            // $array_items = ['role' => '', 'admin_email' => '', 'admin_fullname' => '', 'admin_id' => '', 'user_type' => ''];
            // session()->remove($array_items);
            // session()->remove('attempt_count');
            // session()->remove('showCaptcha');

            // Proceed with setting up session and redirecting
            $data2 = [
                'email' => $this->request->getPost('email'),
                'password' => $hashValidation['org_pwd']
            ];
      
            $result = $homeModel->webLogin($data2);

            if (empty($result)) {
                session()->setFlashdata('msg', '<div class="alert alert-danger text-center">User ID and Password not matched</div>');
                $login_log['PLOGIN_STATUS'] = "Fail- PASSWORD mismatch";
                $this->addAdminLoginLog($login_log);
                return redirect()->to("admin/Home");
            }

            // Set session data
            $session->set([
                'role'           => $result[0]['role'],
                'admin_email'    => $result[0]['admin_email'],
                'admin_fullname' => $result[0]['admin_fullname'],
                'NAME_ID'        => $result[0]['admin_id'],
                'USER_ID'        => $result[0]['user_id'],
                'user_type'      => 'A',
                'profile_image'  => $result[0]['profile_image'],
                'facultystaff'   => $result[0]['facultystaff'],
                'all_menu'       => $this->usersModel->getAllSidebarMenu()
            ]);

            if ($result[0]['role'] == 2) {
                $profiles = json_decode($result[0]['profiles'], true);
                $session->set([
                    'profiles'         => $profiles['profiles'],
                    'assigned_menu'    => $this->usersModel->getMenuAssignedToProfile($profiles['profiles']),
                    'timesheet_menu'   => $this->usersModel->getMenuListAssignedToProfile($profiles['profiles'], '35')
                ]);
                allocate_profiles_schmes_components($profiles['profiles']);
            }

            $session->set('module', $result[0]['role'] == 1 ? 'admin' : 'hr');

            $disp_result = $homeModel->get_display_url($result[0]['admin_email']);

            if (!empty($disp_result)) {
                return redirect()->to($disp_result['display_url']);
            } elseif ($result[0]['role'] == 3) {
                return redirect()->to("admin/Timesheet/attendance");
            } else {
                return redirect()->to("admin/Form/ViewAppList");
            }
        }
    }

    public function home()
    {
        return view('login');
    }
}
