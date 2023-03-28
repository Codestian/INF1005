<?php $title="Login"; $showNavbar = false; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

<link rel="stylesheet" href="../../public/css/auth/login.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 min-vh-100 login-container left-login">
            <?php $quote="Food is symbolic of love when words are inadequate."; $background="../../../public/images/auth/loginBackground.png"; include("views/auth/Background.php"); ?>
        </div>
        <div class="col-lg-6 min-vh-100 login-container right-login">
            <?php include("views/auth/LoginForm.php"); ?>
            <img src="../../public/images/auth/formBackground.png" alt="Form background">
        </div>
    </div>
</div>

<script type="text/javascript" src="../../public/js/auth/login.js"></script>

<?php $showFooter = false; include("views/template/Bottom.php"); ?>
