<?php $showNavbar = false; include("views/template/Top.php"); ?>


<!-- INSERT CONTENT HERE -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 login-container left-login">
            <?php include("views/login/Background.php"); ?>
        </div>
        <div class="col-lg-6 login-container right-login">
            <?php include("views/login/Form.php"); ?>
        </div>
    </div>
</div>

<script>
    document.getElementById("login-form").addEventListener("submit", function(event) {
        event.preventDefault();
        fetch("/api/v1/users")
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error(error));
    });
</script>

<style>
    body {
        padding-top: 0;
    }

    .login-container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .left-login {
        padding: 0;
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
