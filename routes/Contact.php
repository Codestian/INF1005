<?php $title="Contact"; include("views/template/Top.php"); ?>

<?php $heroTitle = "Contact Us";
$heroImage = "../../public/images/contact/hero.png";
include "views/components/Hero.php"; ?>

<section class="container pt-4 px-4">
    <p>
        Thank you for considering to provide us with your feedback.
        <br>
        Please use the form below to provide any feedback or suggestions regarding Chopy's website.
        <br>
        For feedback regarding a particular restaurant, please contact them directly.
        <br>
        If a restaurant is not listed on our site, you can apply to have it listed by heading over to the Work with us page.
    </p>
</section>

<section class="container d-flex justify-content-center">
    <form method="post" class="mt-4 mb-4 ms-5 me-5" style="width: 480px;">
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name.">
        </div>
        <br>
        <div class="form-group">
            <label for="contact">Contact: </label>
            <input type="tel" class="form-control" id="contact" name="contact" placeholder="Enter your Contact no.">
        </div>
        <br>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email.">
            <br>
        </div>
        <div class="form-group">
            <label for="msg">Message: </label>
            <textarea class="form-control" id="msg" name="msg" placeholder="Enter your Feedback here."></textarea>
            <br>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</section>

<?php include("views/template/Bottom.php"); ?>
