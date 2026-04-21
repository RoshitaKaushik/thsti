<?php

namespace App\Models;
use PHPMailer\PHPMailer\PHPMailer;
use CodeIgniter\Model;

class SendmailModel extends Model
{  function __construct()
    {
        // Initialization of class
        parent::__construct();
        $this->load->library('My_NewPHPMailer');
    }

    /**
     * This Function will send mails
     */
    public function send($from = array(), $to = array(), $subject = "", $body, $cc = array(), $bcc = array()){
	    
	    $mail = new PHPMailer();
        //	$mail->SMTPDebug  = 4;
        //  $mail->isMail(); // we are going to use SMTP
        $mail->isSMTP();
        $mail->SMTPAuth = true; // enabled SMTP authentication
		//$mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		$mail->SMTPSecure = 'tls';
        //$mail->Host = 'smtp.gmail.com';      // setting GMail as our SMTP server
        $mail->Host = 'email-smtp.us-east-1.amazonaws.com'; 
        
        //$mail->Port = 465;                   // SMTP port to connect to GMail
        $mail->Port = 587;
        //$mail->Username = 'ithelpdesk@future.edu';  // user email address
        //$mail->Password = '!@admin12';
        $mail->Username = 'AKIAJSNKRAAAHEH4KBYQ';  // user email address
        $mail->Password = 'Aoebain8sd5dbLrmo7KgntWpfqlhMCSz97Rwe7ONKsan';
    //    $mail->CharSet = "UTF-8";
        $mail->isHTML(true);

        $data = [];
        if (is_array($from) && count($from)) {
            $fromEmail = array_key_exists('email', $from) ? $from['email'] : "";
            $fromName = array_key_exists('name', $from) ? $from['name'] : "";
        } else {
            //$fromEmail = 'ithelpdesk@future.edu';
            //$fromName = 'Future edu';
            
            $fromEmail = 'noreply@future.edu';
            $fromName = 'Future edu';
        }

        $mail->SetFrom($fromEmail, $fromName);  //Who is sending the email
        $mail->Subject = $subject;
        $mail->Body = $body;
		
       foreach ($to as $key => $value) {
            $destino = $key; // Who is addressed the email to
            $mail->AddAddress($destino, $value);
        }
		
        foreach ($cc as $key => $value) {
            $destino = $value;
            $mail->AddCC($destino, $value);
        }

        foreach ($bcc as $key => $value) {
            $destino = $value;
            $mail->AddBCC($destino, $value);
        }
		
        if (!$mail->Send()) {
            $data['status'] = 1;
            $data["message"] = "Error: " . $mail->ErrorInfo;
        } else {
            $data['status'] = 0;
            $data["message"] = "Message sent correctly!"  . $mail->ErrorInfo;
        }
        
        return $data;
    }
	
	function getemailsubject($data)
	{
		$res  = "CALL SP_EmailTemplates('{$data['QUERY_TYPE']}','{$data['TEMPLATE_NAME']}',@RES)";
		$res = $this->db->query($res);
		$this->db->connID->next_result();
		return $res->getResultArray();
		$res->free_result();
	}
}
