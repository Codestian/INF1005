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
            <img src="../public/images/about/mission.png"
                 style="width: 100%; max-height: 320px; object-fit: cover;" class="img-fluid rounded-3"
                 alt="Your Image Alt Text Here">
        </div>
    </div>
</section>

<section class="container px-4 pt-5">
    <h2 class="pb-2 fw-bold border-bottom">Our Values</h2>
    <div class="row">
        <?php
            $name = "Accessibility";
            $color = "bg-primary";
            $description="We believe that everyone should be able to access and use our offerings, regardless of their abilities or disabilities.";
            include "views/components/ValuesCard.php";
        ?>
        <?php
            $name = "Reliability";
        $color = "bg-success";
        $description="We are committed to delivering reliable solutions that consistently meet or exceed our customers' expectations.";
            include "views/components/ValuesCard.php";
        ?>
        <?php
            $name = "Transparency";
        $color = "bg-danger";
        $description="We believe in providing our customers with accurate and timely information about our services.";
            include "views/components/ValuesCard.php";
        ?>
        <?php
            $name = "Customer Service";
        $color = "bg-info";
        $description="We prioritize delivering outstanding service, from initial contact to long-term support.";
            include "views/components/ValuesCard.php";
        ?>
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


<?php include("views/template/Bottom.php"); ?>
