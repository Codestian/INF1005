<?php $title="Restaurants"; include("views/template/Top.php"); ?>


<!-- INSERT CONTENT HERE -->
<section>
    <h1>Restaurant master directory here</h1>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <!-- Filter bar goes here -->
            </div>
            <div class="col-lg-10">
                <div class="row row-cols-1 row-cols-md-3 g-4" id="restaurants">
                    <!-- Restaurant divs go here -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let restaurantInfoArr = [];
    const restaurantsDiv = document.getElementById("restaurants");

    function getAllRestaurants(callback) {
        fetch('/api/v1/restaurants')
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    restaurantInfoArr = data.data;
                    console.log(restaurantInfoArr);
                    callback(restaurantInfoArr); // Call the callback function with the data
                }
            })
            .catch(err => {
                console.error(err);
            });
    }

    function displayRestaurants(restaurants) {
        const restaurantsDiv = document.getElementById("restaurants");

        // Loop through each restaurant
        for (let i = 0; i < restaurants.length; i++) {
            const restaurant = restaurants[i];
            restaurant.rating = `restaurant-${restaurant.rating}`;

            // Create the div for the restaurant
            const restaurantDiv = document.createElement("div");
            restaurantDiv.classList.add("col");
            restaurantDiv.id = `restaurant-${restaurant.id}`;

            // Generate the HTML for the restaurant's name with an <a> tag
            const restaurantNameHTML = `<h2><a href="/restaurants/${restaurant.id}">${restaurant.name}</a></h2>`;

            // Generate the HTML for the restaurant's description
            const restaurantDescHTML = `<p>${restaurant.description}</p>`;

            // Generate the HTML for the restaurant's rating
            const starsHTML = '<div class="rating-stars">' +
                    '<span class="star">&#9733;</span>' +
                    '<span class="star">&#9733;</span>' +
                    '<span class="star">&#9733;</span>' +
                    '<span class="star">&#9733;</span>' +
                    '<span class="star">&#9733;</span>' +
                        '</div>';

            // Function for stars ratingplac
            // const ratingStars = document.querySelector('.rating-stars');
            const rating = `restaurant-${restaurant.rating}`;
            console.log(rating);

            // Calculate the number of filled stars based on the rating value
            const filledStars = Math.floor(restaurant.rating);

            // Fill in the appropriate number of stars by adding the `.filled` class
            for (let i = 0; i < filledStars; i++) {
                restaurantDiv.querySelector('.rating-stars').children[i].classList.add('filled');
            }

            // If the rating is not a whole number, fill in the last partial star
            if (rating % 1 > 0) {
                restaurantDiv.querySelector('.rating-stars').children[filledStars].innerHTML = '&#9733;&#189;';
                restaurantDiv.querySelector('.rating-stars').children[filledStars].classList.add('filled');
            }

            const restaurantRatingHTML = starsHTML;

            // Append the restaurant name and description to the restaurant div
            restaurantDiv.innerHTML = restaurantNameHTML + restaurantRatingHTML;

            // Append the restaurant div to the restaurants div
            restaurantsDiv.appendChild(restaurantDiv);
        }
    }

    // Call the function and pass in the callback function
    getAllRestaurants(displayRestaurants);
</script>

<style>
    .rating-stars .star {
        font-size: 1.2em;
        color: #ddd;
    }

    .rating-stars .star.filled {
        color: #ff9800;
    }
</style>

<?php include("views/template/Bottom.php"); ?>
