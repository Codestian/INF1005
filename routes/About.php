<?php $title = "About";
include("views/template/Top.php"); ?>

<?php $title = "About Us";
include "views/components/Hero.php"; ?>


<section class="container px-4 pt-5">
    <div class="row">
        <div class="col-md-6">
            <h2 class="pb-2 fw-bold border-bottom">Our Mission</h2>
            <p>
                Finding and booking a restaurant should be easy and convenient. <br>
                We've developed a user-friendly platform that allows you to browse a curated selection of restaurants. Our platform
                features real-time availability updates, automatic confirmation and reminder messages, and the ability
                to modify or cancel reservations as needed. <br>
                Our goal is to help you focus on enjoying your dining
                experience, leaving the rest to us.
            </p>
        </div>
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                 style="width: 100%; max-height: 320px; object-fit: cover;" class="img-fluid rounded-4"
                 alt="Your Image Alt Text Here">
        </div>
    </div>
</section>

<section class="container px-4 pt-5">
    <h2 class="pb-2 fw-bold border-bottom">Our Team</h2>
    <div class="row">
       <?php $name="Hakim"; $job="CEO - Founder"; include "views/components/AboutTeam.php"; ?>
        <?php $name="Alan"; $job="Marketing Manager"; include "views/components/AboutTeam.php"; ?>
        <?php $name="Zhi Yin"; $job="Customer Support Specialist"; include "views/components/AboutTeam.php"; ?>
        <?php $name="Hid"; $job="Technical Support"; include "views/components/AboutTeam.php"; ?>
        <?php $name="Manav"; $job="Web Developer"; include "views/components/AboutTeam.php"; ?>
    </div>
</section>

<section class="container px-4 pt-5">
    <h2 class="pb-2 fw-bold border-bottom">Our Partners</h2>
</section>

<style>
    .container {
        /*background: red;*/
    }
</style>

<?php include("views/template/Bottom.php"); ?>
