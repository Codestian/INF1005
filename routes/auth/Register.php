<?php $title="Register"; $showNavbar = false; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 min-vh-100 login-container left-login">
            <?php $quote="Food is our common ground, a universal experience."; $background="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&q=80"; include("views/auth/Background.php"); ?>
        </div>
        <div class="col-lg-6 min-vh-100 login-container right-login">
            <?php include("views/auth/RegisterForm.php"); ?>
        </div>
    </div>
</div>

<script>
    const registerAlert = document.querySelector('#register-alert');

    const registerEmail = document.querySelector('#register-email');
    const registerUsername = document.querySelector('#register-username');
    const registerPassword = document.querySelector('#register-password');
    const registerPasswordConfirm = document.querySelector('#register-password-confirm');

    registerAlert.style.display = 'none';

    document.querySelector("#register-form").addEventListener("submit", (e) => {
        e.preventDefault();
        // Sanitize and trim the input values
        const sanitizedEmail = registerEmail.value.trim();
        const sanitizedUsername = registerUsername.value.trim();
        const sanitizedPassword = registerPassword.value.trim();
        const sanitizedPasswordConfirm = registerPasswordConfirm.value.trim();

        if(sanitizedPassword === sanitizedPasswordConfirm) {
            fetch("/api/v1/auth/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "email": sanitizedEmail,
                    "username": sanitizedUsername,
                    "password": sanitizedPassword
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if(data.status !== 200) {
                        registerAlert.style.display = 'block';
                        registerAlert.textContent = data.data.message;
                    }
                    else {
                        // User account creation successful, redirect user to home.
                        alert('Welcome! You are now registered.');
                        window.location.href = "/";
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
        else {
            registerAlert.style.display = 'block';
            registerAlert.textContent = "Passwords do not match.";
        }

    });
</script>

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

