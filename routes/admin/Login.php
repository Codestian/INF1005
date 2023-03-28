<?php $title="Admin Login"; $showNavbar = false; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

<section>
    <head>

        <title>Admin Login Page</title>

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="../../public/css/adminLogin.css" >
    </head>.
    <body class="text-center">

    <main class="form-signin w-100 m-auto">
        <div class ="form-box">
            <form>
                <img class="mb-4" src="../../public/images/AdminLogin.png" alt="" width="100" height="60">
                <h1 class="h3 mb-3 fw-normal">Admin</h1>

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


    </main>



    </body>
</section>

<?php $showFooter = false; include("views/template/Bottom.php"); ?>
