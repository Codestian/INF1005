<?php $title="Admin Login"; $showNavbar = true; $mainPaddingTop = "0"; include("views/template/Top.php"); ?>

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
            <input type="email" class="form-control" id="login-email" placeholder="name@example.com">
            <label for="login-email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="login-password" placeholder="Password">
            <label for="login-password">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" id="remember-me" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>

    </form>
    </div>


</main>



</body>
<script type="text/javascript" src="../../public/js/admin/login.js"></script>
<!--</html>-->


<?php $showFooter = false; include("views/template/Bottom.php"); ?>
