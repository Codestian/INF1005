<form class="text-center fade-left" id="login-form">
    <h1 class="h3 mb-3 fw-bold text-start">Login</h1>
    <div class="form-floating mb-2">
        <input type="email" class="form-control" id="login-email" placeholder="name@example.com" required>
        <label for="login-email">Email address...</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="login-password" placeholder="Password" required>
        <label for="login-password">Password...</label>
    </div>
    <div class="alert alert-danger mb-3 text-start" id="login-alert" role="alert">
    </div>
    <button class="w-100 btn btn-lg btn-success mb-3" type="submit">Login</button>
    <button type="button" id="google-login" class="btn w-100 btn-lg btn-primary mb-3" style="--bs-btn-font-size: .8rem;">Continue with Google</button>
    <button type="button" id="apple-login" class="btn w-100 btn-lg btn-dark mb-3" style="--bs-btn-font-size: .8rem;">Continue with Apple</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
</form>
