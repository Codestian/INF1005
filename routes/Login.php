<?php $showNavbar = false; include("views/template/Top.php"); ?>


<!-- INSERT CONTENT HERE -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 login-container left-login">
            <div class="login-hero-text">
                <h2>Food is symbolic of love when words are inadequate.</h2>
            </div>
            <div class="login-hero-gradient"></div>
            <div class="login-hero-overlay"></div>
            <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&q=80" alt="">
        </div>
        <div class="col-lg-6 login-container right-login">
            <form>
                <img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        padding-top: 0;
    }

    .login-container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .left-login {
        padding: 0;
        position: relative;
    }

    .login-hero-text {
        padding: 32px;
        position: absolute;
        bottom: 0;
        left: 0;
        z-index: 3;
    }

    .login-hero-text h2 {
        color: white;
        font-weight: bold;
        font-size: 2.4rem;
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

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
    }


</style>
<?php $showFooter = false; include("views/template/Bottom.php"); ?>
