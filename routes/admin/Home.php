<?php $title = "Admin Home";
$showNavbar = false;
$mainPaddingTop = "0";
include("views/template/Top.php"); ?>
    <div class="d-flex">
        <?php include("views/admin/components/Sidebar.php"); ?>
        <section class="container-fluid" style="padding: 0; height: 100vh; overflow: auto;">
            <h1>Welcome to Admin page</h1>
        </section>
    </div>

<?php $showFooter=false; include("views/template/Bottom.php"); ?>