<nav class="navbar fixed-top">
    <div class="container-fluid text-center row row-cols-3" style="padding-left: 50px">

            <button class="col-sm-auto navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar" aria-label="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Chopee Directory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" </button>
                </div>
                <div class="offcanvas-body">

                    <form class="d-flex mt-3" role="search">
                        <input class="form-control form-control-lg me-2" type="search" placeholder="Find a Store here!" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="master">Master Directory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>

        <div class="col-md-auto" style="padding-left: 170px"><a class="nav-link" href="/"><img src="../../../public/images/borgor-small.png" alt="burger-icon">Chopee</a></div>

        <div class="col-sm-auto"><a class="btn btn-primary login" href="login" role="button">Sign Up or Login</a></div>
    </div>
</nav>
