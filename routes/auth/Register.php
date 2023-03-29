<?php $title="Register"; $showNavbar = false; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

<link rel="stylesheet" href="../../public/css/auth/auth.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 min-vh-100 auth-container left-auth">
            <?php $quote="Food is our common ground, a universal experience."; $background="../../../public/images/auth/registerBackground.png"; include("views/auth/Background.php"); ?>
        </div>
        <div class="col-lg-6 min-vh-100 auth-container right-auth">
            <div class="home-button">
                <a class="btn btn-dark" href="/">&lt;</a>
            </div>
            <?php include("views/auth/RegisterForm.php"); ?>
            <img src="../../public/images/auth/formBackground.png" alt="Form background">
        </div>
    </div>
</div>

<script type="text/javascript" src="../../public/js/auth/register.js"></script>

<?php $showFooter = false; include("views/template/Bottom.php"); ?>

