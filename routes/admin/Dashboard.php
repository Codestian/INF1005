<?php $title = "Admin Dashboard";
$showNavbar = false;
$mainPaddingTop = "0";
include("views/template/Top.php"); ?>
    <div class="d-flex">
        <nav class="sidebar-container">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="/admin/dashboard"></use></svg>
                    <span class="fs-4">Admin</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link text-white" aria-current="page">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/admin/dashboard/restaurants" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Restaurants
                        </a>
                    </li>
                    <li>
                        <a href="/admin/dashboard/roles" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Roles
                        </a>
                    </li>
                    <li>
                        <a href="/admin/dashboard/items" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Items
                        </a>
                    </li>
                    <li>
                        <a href="/admin/dashboard/users" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Users
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="/">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="container-fluid" style="padding: 0; height: 100vh; overflow: auto;">
            <?php
            switch ($table_name) {
                case 'users':
                case 'items':
                case 'roles':
                case 'restaurants':
                    include("views/admin/Database.php");
                    break;
                default:
                    break;
            }
            ?>
        </section>
    </div>

    <script type="text/javascript" src="../../public/js/admin/sidebar.js"></script>
    <script type="text/javascript" src="../../public/js/admin/tableHandling.js"></script>

<?php $showFooter=false; include("views/template/Bottom.php"); ?>