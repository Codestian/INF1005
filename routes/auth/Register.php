<?php $title="Register"; $showNavbar = false; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 min-vh-100 login-container left-login">
            <?php $quote="Food is our common ground, a universal experience."; $background="../../../public/images/auth/registerBackground.png"; include("views/auth/Background.php"); ?>
        </div>
        <div class="col-lg-6 min-vh-100 login-container right-login">
            <?php include("views/auth/RegisterForm.php"); ?>
            <img src="../../../public/images/auth/formBackground.png" alt="Form background">
        </div>
    </div>
</div>

<script type="text/javascript" src="../../public/css/auth/register.js"></script>

<style>
    body {
        padding-top: 0;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .left-login {
        padding: 0;
    }

    @media (max-width: 992px) {
        .left-login {
            display: none;
        }
    }

    .login-hero-text {
        padding: 32px;
        position: absolute;
        bottom: 0;
        left: 0;
        z-index: 3;
    }

    .login-hero-gradient {
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.6));
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
    }

    .login-hero-overlay {
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
    }

    .left-login img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
    }

    .right-login form {
        width: 300px;
        z-index: 1;
    }

    .right-login img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
        opacity: 0.05;
    }

</style>

<?php $showFooter = false; include("views/template/Bottom.php"); ?>

