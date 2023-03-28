<?php $title="Register"; $showNavbar = false; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

<link rel="stylesheet" href="../../public/css/auth/register.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 min-vh-100 login-container left-login">
            <?php $quote="Food is our common ground, a universal experience."; $background="../../../public/images/auth/registerBackground.png"; include("views/auth/Background.php"); ?>
        </div>
        <div class="col-lg-6 min-vh-100 login-container right-login">
            <?php include("views/auth/RegisterForm.php"); ?>
            <img src="../../public/images/auth/formBackground.png" alt="Form background">
        </div>
    </div>
</div>

<script type="text/javascript" src="../../public/js/auth/register.js"></script>

<?php $showFooter = false; include("views/template/Bottom.php"); ?>

