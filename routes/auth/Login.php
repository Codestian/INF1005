<?php $title="Login"; $showNavbar = false; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 min-vh-100 login-container left-login">
            <?php $quote="Food is symbolic of love when words are inadequate."; $background="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&q=80"; include("views/auth/Background.php"); ?>
        </div>
        <div class="col-lg-6 min-vh-100 login-container right-login">
            <?php include("views/auth/LoginForm.php"); ?>
        </div>
    </div>
</div>

<script>
    const loginAlert = document.querySelector('#login-alert');

    const loginEmail = document.querySelector('#login-email');
    const loginPassword = document.querySelector('#login-password');

    loginAlert.style.display = 'none';

    document.querySelector("#login-form").addEventListener("submit", (e) => {
        e.preventDefault();

        const sanitizedEmail = loginEmail.value.trim();
        const sanitizedPassword = loginPassword.value.trim();

        fetch("/api/v1/auth/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                "email": sanitizedEmail,
                "password": sanitizedPassword
            }),
        })
            .then(response => response.json())
            .then(data => {
                if(data.status !== 200) {
                    loginAlert.style.display = 'block';
                    loginAlert.textContent = data.data.message;
                }
                else {
                    alert("You are logged in. Welcome!");
                    window.location.href = "/";
                }
            })
            .catch(error => {
                console.error(error);
                loginAlert.style.display = 'block';
                loginAlert.textContent = "Please try again";
            });
    });

    document.querySelector("#google-login").addEventListener("click", (e) => {
        e.preventDefault();
        fetch("/api/v1/auth/google/url")
            .then(response => response.json())
            .then(data => window.location.href = data.data.url)
            .catch(error => console.error(error));
    })

    document.querySelector("#apple-login").addEventListener("click", (e) => {
        e.preventDefault();
        alert('Apple Sign In not implemented. Requires $$$.');
    })
</script>

<style>
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
        z-index: -1;
        opacity: 0.05;
    }
</style>

<?php $showFooter = false; include("views/template/Bottom.php"); ?>
