<?php $title = "Admin Dashboard";
$showNavbar = false;
$mainPaddingTop = "0";
include("views/template/Top.php"); ?>
    <div class="d-flex">
        <?php include("views/admin/components/Sidebar.php"); ?>
        <section class="container-fluid" style="padding: 0; height: 100vh; overflow: auto;">
            <?php
            switch ($table_name) {
                case 'restaurants':
                case 'roles':
                case 'items':
                case 'reviews':
                case 'reservations':
                case 'users':
                case 'regions':
                case 'providers':
                    include("views/admin/Database.php");
                    break;
                default:
                    break;
            }
            ?>
        </section>
    </div>

    <script type="text/javascript" src="../../public/js/admin/sidebar.js"></script>
    <script type="text/javascript" src="../../public/js/handle.js"></script>
    
<?php $showFooter=false; include("views/template/Bottom.php"); ?>