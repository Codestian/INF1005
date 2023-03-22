<?php $title="Login"; $showNavbar = false; include("views/template/Top.php"); ?>

<div class="container-fluid redirect-container min-vh-100">
    <h1 class="h3 fw-bold text-center" id="login-text">Logging in...</h1>
    <form class="text-center" id="register-form">
        <!--                <img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
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

<style>

    body {
        padding-top: 0;
    }

    .redirect-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .redirect-container form {
        z-index: 1;
    }

    .redirect-container img {
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

<script>

    const loginText = document.querySelector('#login-text');
    const registerForm = document.querySelector('#register-form');
    const registerUsername = document.querySelector('#register-username');
    const registerButton = document.querySelector('#register-button');

    registerForm.style.display = 'none';

    const urlParams = new URLSearchParams(window.location.search);

    // Retrieve a specific query parameter
    const paramValue = urlParams.get('code');

    if(paramValue) {
        fetch("/api/v1/auth/google/login?code=" + paramValue)
            .then(response => response.json())
            .then(data => {
                if(!data.message.isRegistered) {
                    registerUsername.value = data.message.username;
                    registerForm.style.display = 'block';
                    loginText.style.display = 'none';
                }
                else {
                    window.location.href = "/";
                }
            })
            .catch(error => console.error(error));
    }

    registerButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = "/";
        console.log('continue to website');
    })
</script>

<?php $showFooter = false; include("views/template/Bottom.php"); ?>
