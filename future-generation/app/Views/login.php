<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Future Generations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
        =========================================================
        * ArchitectUI HTML Theme Dashboard - v1.0.0
        =========================================================
        * Product Page: https://dashboardpack.com
        * Copyright 2019 DashboardPack (https://dashboardpack.com)
        * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
        =========================================================
        * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
        -->
    <link href="<?= base_url('assets/logAsset/main.css'); ?>" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url('assets/logAsset/scripts/main.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/web/js/jquery-2.1.4.min.js'); ?>"></script>
    <style>
        .email_with_login {
            display: none;
        }

        .captcha-outer-box .captcha-btn-box small {
            background: #3f6ad8;
            height: 47px !important;
            display: block;
            border-radius: 10px;
        }

        .captcha-btn-box {
            margin: 0 5px;
            float: left;
        }

        .captcha-img-box {
            float: left;
            margin-bottom: 20px;
        }


        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: rgba(6, 5, 5, 1);
            margin: auto;
            padding: 0;
            width: 38%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px 15px;
            background-color: rgba(6, 5, 5, 1);
            color: white;
            border-bottom: 1px solid grey;
        }

        .modal-body {
            padding: 10px 38px 20px;
        }

        .forget_part {
            display: none;
        }
    </style>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="d-none d-lg-block col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider">
                                <div class="">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('../assets/logAsset/images/originals/city.png');"></div>
                                        <div class="slider-content">
                                            <!--h3>Perfect Balance</h3>
                                                <p>ArchitectUI is like a dream. Some think it's too good to be true! Extensive
                                                collection of unified React Boostrap Components and Elements.
                                                </p-->
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('../assets/logAsset/images/originals/citynights.png');"></div>
                                        <div class="slider-content">
                                            <!--h3>Scalable, Modular, Consistent</h3>
                                                <p>Easily exclude the components you don't require. Lightweight, consistent
                                                Bootstrap based styles across all elements and components
                                                </p-->
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('../assets/logAsset/images/originals/citydark.png');"></div>
                                        <div class="slider-content">
                                            <!--h3>Complex, but lightweight</h3>
                                                <p>We've included a lot of components that cover almost all use cases for any type of application.</p-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-100 mobile-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">


                        <!-- Forget Password -->
                        <div class="mx-auto app-login-box col-sm-12 col-md-8 col-lg-6 forget_part">
                            <div class="app-logo"></div>
                            <h4>
                                <div>Forgot your Password?</div>
                                <span>Use the form below to recover it.</span>
                            </h4>
                            <div>
                                <form action="<?= base_url('admin/Home/forgotpwd'); ?>" role="login" method="post" accept-charset="utf-8">
                                    <input type="hidden" name="csrf_token" value="e840f0b3c9827edc6084fb787f1963e9" />
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="">Email</label>
                                                <input name="email" placeholder="Email here..." type="email" class="form-control" autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center">
                                        <h6 class="mb-0">
                                            <a href="javascript:void(0);" class="text-primary sign_btn">Sign in existing account</a>
                                        </h6>
                                        <div class="ml-auto">
                                            <button class="btn btn-primary btn-lg">Recover Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Forget Password -->

                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9 login_part">
                            <div class="col-md-12 result_msg">
                                <?php if (session()->getFlashdata('msg')): ?>
                                    <div class="alert-message">
                                        <?= session()->getFlashdata('msg'); ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <!-- <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9 login_part">
                                <div class="col-md-12 result_msg">
                                </div> -->


                            <div class="app-logo"></div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <h4 class="mb-0">
                                        <span class="d-block">Welcome back,</span>
                                        <span class="d-block">Please sign in to your account.</span>
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?= base_url('login/google_login'); ?>">
                                        <button class="btn-light-green" type="button">
                                            <img src="<?= base_url('assets/webs/images/gicon.png'); ?>">Log In with Google
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <h6 class="mt-3" style="display:inline;"><a href="javascript:void(0);" class="text-primary email_btn">Log In with Email</a></h6>
                            <h6 class="mt-3" style="display:inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h6>
                            <h6 class="mt-3" style="display:inline;"><a href="javascript:void(0);" class="text-primary">Privacy Policy</a></h6>
                            <div class="divider row"></div>
                            <div class="email_with_login">

                                <form class="" action="<?= base_url('admin/Home/login'); ?>" role="login" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="">Email</label>
                                                <input name="email" id="email" placeholder="Email here..." type="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword" class="">Password</label>
                                                <input class="form-control" type="password" id="pass" name="pass" placeholder="Password" autocomplete="new-password" required />
                                                <input autocomplete="new-password" type="hidden" id="password" name="password" />
                                                <input type="hidden" name="csrf_token" value="e840f0b3c9827edc6084fb787f1963e9">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-6">
                                            <div class="position-relative form-check">
                                                <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                                                <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="ml-auto text-right">
                                                <a id="myBtn1" href="javascript:void(0);" class="btn-lg btn btn-link forget_btn">Forgot Password ?</a>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <div class="form-row12">
                                        <div class="captcha-outer-box form-row">

                                            <div class="col-md-6">
                                                <div class="captcha-img-box">
                                                    <img style="height:47px; width: 235px;" src="<?= base_url('captcha'); ?>" id='captchaimg' />
                                                </div>



                                                <div class="captcha-btn-box">
                                                    <small>
                                                        <a href='javascript:;' style="color:blue;margin:0;" onClick="document.getElementById('captchaimg').src = '<?= base_url('captcha'); ?>?' + Math.random(); 
                    					return false">
                                                            <img src="<?= base_url('assets/images/refresh.png'); ?>">
                                                        </a>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="captcha-form col-md-6" style="margin-top:5px">
                                                <input type="text" name="captcha" value="" id="captcha" autocomplete="off" class="form-control" placeholder="Enter Captcha" required="required" />

                                            </div>

                                            <div style="clear:both;"></div>

                                        </div>
                                    </div> -->

                                   <?php if (session()->get('showCaptcha')): ?>
                                        <div class="form-row12">
                                            <div class="captcha-outer-box form-row">
                                                <div class="col-md-6">
                                                    <div class="captcha-img-box">
                                                        <img style="height:47px; width: 235px;" src="<?= base_url('captcha'); ?>" id='captchaimg' />
                                                    </div>
                                                    <div class="captcha-btn-box">
                                                        <small>
                                                            <a href='javascript:;' style="color:blue;margin:0;" onClick="document.getElementById('captchaimg').src = '<?= base_url('captcha'); ?>?' + Math.random(); return false">
                                                                <img src="<?= base_url('assets/images/refresh.png'); ?>">
                                                            </a>
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="captcha-form col-md-6" style="margin-top:5px">
                                                    <input type="text" name="captcha" value="" id="captcha" autocomplete="off" class="form-control" placeholder="Enter Captcha" required />
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                    <div class="divider row"></div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center form-group">
                                                <div class="mr-auto">
                                                    <button class="btn btn-primary btn-lg" onclick="return HashPass();">Log In</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mobile-center">
                                            <div class="position-relative form-group google-pay">
                                                <span>
                                                    <a href="https://play.google.com/store/apps/details?id=com.akalinfosys.attendance" target="_blank" style="text-align: left ! important;">
                                                        <img src="<?= base_url('assets/icon/google.png'); ?>" style="width:140px">
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="position-relative form-group google-pay">
                                                <span>
                                                    <a href="https://apps.apple.com/in/app/futuregen-attendance/id1399518544" target="_blank" style="text-align: left ! important;">
                                                        <img src="<?= base_url('assets/icon/apple.png'); ?>" style="width:140px">
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 login_with_gmail mobile-center">
                                    <div class="position-relative form-group google-pay">
                                        <span>
                                            <a href="https://play.google.com/store/apps/details?id=com.akalinfosys.attendance" target="_blank" style="text-align: left ! important;">
                                                <img src="<?= base_url('assets/icon/google.png'); ?>" style="width:140px">
                                            </a>
                                        </span>
                                    </div>
                                    <div class="position-relative form-group google-pay">
                                        <span>
                                            <a href="https://apps.apple.com/in/app/futuregen-attendance/id1399518544" target="_blank" style="text-align: left ! important;">
                                                <img src="<?= base_url('assets/icon/apple.png'); ?>" style="width:140px">
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="copyright" style=" margin-bottom: 10px;width: 100%; bottom: 0;">
                                    <center>
                                        <p>© 2025. All rights reserved. Confidential information subject to USA law</p>
                                    </center>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2 style="margin-bottom: 10px;margin-top: 30px;text-transform: uppercase;font-size: 20px;color: white;font-weight: 600;letter-spacing: 2px;text-align: center;">Forgot Password</h2>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/Home/forgotpwd'); ?>" class="form-horizontal m-t-20" role="login" method="post" accept-charset="utf-8">
                    <input type="hidden" name="csrf_token" value="e840f0b3c9827edc6084fb787f1963e9" />


                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" autocomplete="new-password" required />
                    <button class="btn-light-green" style="width:98%" type="submit">Submit</button>

                </form>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $(".result_msg").fadeOut(10000);
        })
        $(document).on('click', '.forget_btn', function() {
            $('.login_part').hide();
            $('.forget_part').show();
        })
        $(document).on('click', '.sign_btn', function() {
            $('.login_part').show();
            $('.forget_part').hide();
        })

        function HashPass() {
            var pass = $('#pass').val();
            var email = $('#email').val();
            var captcha = $('#captcha').val();
            var sessName = "<?= session()->get('showCaptcha') ? '1' : ''; ?>"; // dynamic
            var salt = '';
            var flag = true;

            if (!email) {
                alert('Email is required');
                return false;
            }

            if (!pass) {
                alert('Password is required');
                return false;
            }

            if (sessName) {
                if (!captcha) {
                    alert('Captcha code is required');
                    return false;
                }
            }

            var hex_pwd = hex_md5(String(pass));
            // var hex = hex_md5(String(hex_pwd))
            $('#password').val(hex_pwd);
            $('#pass').val('***************************************');
            return true;
        }


        $(document).on('click', '.email_btn', function() {
            $(".email_with_login").toggle();
            $(".login_with_gmail").toggle();
        })
    </script>

    <script>
        $(function() {

            var base_url = 'http://localhost:8080/';
            $('.reload-captcha').click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: base_url + 'dashboard/create_captcha?' + Math.random(),
                    success: function(data) {
                        $('.captcha-img').attr('src', data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript" src="<?= base_url('assets/js/MD5.js'); ?>"></script>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // Check if elements exist before binding
            if (btn && modal && span) {
                // When the user clicks the button, open the modal 
                btn.onclick = function() {
                    modal.style.display = "block";
                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                }
            } else {
                console.warn("Modal elements not found in the DOM.");
            }

            // Slick slider auto play
            if ($('.slick').length > 0 && typeof $.fn.slick === 'function') {
                $('.slick').slick('slickPlay');
            }
        });
    </script>


    <!--script>
	$(document).ready(
    function(){
    	login_email.style.display = "none";
        $("#login_button").click(function () {
            //$("#login_email").show("slow");
             login_email.style.display = "block";
        });

    });
</script-->


</body>

</html>