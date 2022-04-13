<?php
$currPage = 'front_Register_auth';
include 'app/controller/PageController.php';
include 'app/manager/customer/auth/register.php';
?>
<div class="back-to-home rounded d-none d-sm-block">
    <a href="<?= $helper->url(); ?>" class="btn btn-icon btn-soft-primary"><i data-feather="home" class="icons"></i></a>
</div>

        <!-- Hero Start -->
        <section class="bg-auth-home bg-circle-gradiant d-table w-100">
            <div class="bg-overlay bg-overlay-white"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8"> 
                        <div class="card shadow rounded border-0 mt-4">
                            <div class="card-body">
                                <h4 class="card-title text-center">Account erstellen</h4>  
                                <form class="login-form" method="post">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group"> 
                                                <label>Benutzername <span class="text-danger">*</span></label>
                                                <div class="position-relative">
                                                    <i data-feather="user-check" class="fea icon-sm icons"></i>
                                                    <input type="text" class="form-control pl-5" placeholder="Benutzername" name="username" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>E-Mail <span class="text-danger">*</span></label>
                                                <div class="position-relative">
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input type="email" class="form-control pl-5" placeholder="Email" name="email" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Passwort <span class="text-danger">*</span></label>
                                                <div class="position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" class="form-control pl-5" placeholder="Password" name="password" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Passwort wiederholen <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="password" class="form-control pl-5" placeholder="Password wiederholen" name="password_repeat" required="">
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">Ich akzeptiere die <a href="<?= $helper->url(); ?>agb" class="text-primary">AGBs</a> und die <a href="<?= $helper->url(); ?>datenschutz" class="text-primary">Datenschutzerklärung</a></label>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <center><div class="g-recaptcha" data-sitekey="<?= $grecaptchaSiteKey ?>"></div></center>
                                            <br>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-block" name="register">Account erstellen</button>
                                        </div><!--end col-->

                                        <div class="mx-auto">
                                            <p class="mb-0 mt-3"><small class="text-dark mr-2">Bereits ein Account?</small> <a href="<?= $helper->url(); ?>login" class="text-dark font-weight-bold">Anmelden</a></p>
                                        </div>
                                    </div><!--end row-->
                                </form>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </section><!--end section-->
        <!-- Hero End -->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>