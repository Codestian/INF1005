<!-- Page template -->
<!DOCTYPE html>
<html lang="en">
<?php
include("views/template/elements/Head.php"); ?>
<body>
<?php
if(!isset($showNavbar) || $showNavbar) {
    include("views/template/elements/Navbar.php");
}
?>
<main style="min-height: 100vh; padding-top:<?php echo $mainPaddingTop ?? "56"; ?>px">