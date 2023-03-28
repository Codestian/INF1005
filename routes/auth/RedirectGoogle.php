<?php $title="Login"; $showNavbar = false; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

<link rel="stylesheet" href="../../public/css/auth/redirectGoogle.css">

<div class="container-fluid redirect-container min-vh-100">
    <div class="justify-content-center" id="loading-container">
        <div class="d-flex">
            <div class="spinner-border me-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h1 class="h3 fw-bold text-center">Logging in...</h1>
        </div>
    </div>
    <form class="text-center" id="register-form">
        <h1 class="h3 mb-2 fw-bold text-start">Welcome!</h1>
        <p class="mb-3 text-muted">Please choose a username</p>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="register-username" placeholder="PLACEHOLDER">
            <label for="floatingInput">Username...</label>
        </div>
        <button id="register-button" class="w-100 btn btn-lg btn-primary mb-3" type="submit">Continue</button>
    </form>
    <img src="https://images.unsplash.com/photo-1470790376778-a9fbc86d70e2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&q=80" alt="">
</div>

<script type="text/javascript" src="../../public/js/auth/redirectGoogle.js"></script>

<?php $showFooter = false; include("views/template/Bottom.php"); ?>
