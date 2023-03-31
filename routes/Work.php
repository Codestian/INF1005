<?php $title="Template"; include("views/template/Top.php"); ?>

<?php $heroTitle = "Work With Us";
$heroImage = "../../public/images/Work.jpg";
include "views/components/Work.php"; ?>

<!-- INSERT CONTENT HERE -->
<section class="container pt-4 px-4">
    <p>
        Welcome to Choppy, where we connect restaurants with food enthusiasts in their community.
        <br>
        Joining our website provides an opportunity for your restaurant to increase its online visibility and attract new customers.
        <br>
        By joining our platform, you'll gain access to valuable features like online reservation booking, menu browsing, and user reviews.
        <br>
        Our mobile-responsive webpage design ensures that your restaurant will be accessible to potential customers on any device.
        <br>
        Don't miss out on the chance to promote your restaurant to a wider audience
        <br>- sign up now and start reaping the benefits of our platform.
    </p>
</section>

<section class="container d-flex justify-content-center">
    <form method="post" id="restaurant-signup">
        <div class="row">
            <div class="col">
                <h2>Sign Up for an Account</h2>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="register-email" required placeholder="name@example.com">
                    <label for="register-email">Email address...</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="register-username" required placeholder="username">
                    <label for="register-username">Username...</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="register-password" required placeholder="password">
                    <label for="register-password">Password...</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="register-password-confirm" required placeholder="passwordconfirm">
                    <label for="register-password-confirm">Confirm password...</label>
                </div>
            </div>

        <div class="col">
            <h2>Enter your Restaurant Details</h2>
            <div class="form-group">
                <label for="restaurant-name">Restaurant Name: </label>
                <input type="text" class="form-control" id="restaurant-name" required name="restaurant-name" placeholder="Enter the Restaurant's name.">
            </div>
            <br>

            <div class="form-group">
                <label for="restaurant-contact">Contact: </label>
                <input type="tel" class="form-control" id="restaurant-contact" required name="restaurant-contact" placeholder="Enter the Restaurant Contact no.">
            </div>
            <br>

            <div class="form-group">
                <label for="restaurant-openinghour">Opening Hours: </label>
                <input type="time" class="form-control" id="restaurant-openinghour" required name="restaurant-openinghour" placeholder="Enter the opening hours of the Restaurant.">
            </div>
            <br>

            <div class="form-group">
                <label for="restaurant-closinghour">Closing Hours: </label>
                <input type="time" class="form-control" id="restaurant-closinghour" required name="restaurant-closinghour" placeholder="Enter the closing hours of the Restaurant.">
            </div>
            <br>

            <div class="form-group">
                <label for="restaurant-address">Address: </label>
                <input type="text" class="form-control" id="restaurant-address" required name="restaurant-address" placeholder="Enter the Address of the Restaurant.">
            </div>
            <br>

            <div class="form-group">
                <label for="restaurant-pricing">Pricing Range: </label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control" id="restaurant-pricing" required name="restaurant-pricing" placeholder="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="restaurant-cuisine">Cuisine Type: </label>
                <select class="form-select" required id="restaurant-cuisine">
                    <option selected>Choose a Cuisine Type...</option>
                    <option value="1">Thai</option>
                    <option value="2">Italian</option>
                    <option value="3">Chinese</option>
                    <option value="4">Mexican</option>
                    <option value="5">Minangkabau</option>
                    <option value="6">Fast Food</option>
                </select>
            </div>
            <br>

            <div class="form-group">
                <label for="restaurant-region">Region: </label>
                <select class="form-select" required id="restaurant-region">
                    <option selected>Choose a Region...</option>
                    <option value="1">North</option>
                    <option value="2">South</option>
                    <option value="3">East</option>
                    <option value="4">West</option>
                </select>
            </div>
            <br>

            <div class="form-group">
                <label for="restaurant-description">Description: </label>
                <textarea class="form-control" id="restaurant-description" required name="restaurant-description" placeholder="Enter the Restaurant Description."></textarea>
                <br>
            </div>
        </div>
        </div>
        <div class="row my-1">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</section>

<script type="text/javascript" src="../../public/js/auth/restaurants.js"></script>

<?php include("views/template/Bottom.php"); ?>