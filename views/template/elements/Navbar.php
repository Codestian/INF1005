<nav class="navbar navbar-expand-md fixed-top bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../../../public/images/borgor-small.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Choppy
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0 text-center" id="nav-links">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/restaurants">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/work">Work with us</a>
                </li>
            </ul>
            <div class="d-flex align-items-center justify-content-center">
                <div class="flex-shrink-0 dropdown flex-row d-flex align-items-center" id="nav-dropdown">
                    <span class="me-3 text-end" id="nav-username"></span>
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small shadow" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 34px);" data-popper-placement="bottom-end">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" id="logout-btn" href="#">Logout</a></li>
                    </ul>
                </div>
                <div id="nav-auth">
                    <a href="/register" class="btn btn-outline-dark me-2">Register</a>
                    <a href="/login" class="btn btn-warning">Login</a>
                </div>
            </div>
        </div>
    </div>
</nav>
