<?php $title="Restaurants"; include("views/template/Top.php"); ?>

<?php $heroTitle = "Welcome to the Master Directory";
$heroImage = "../../public/images/Food.jpg";
include "views/components/Food.php"; ?>

<!-- INSERT CONTENT HERE -->
<section>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="filter-bar mb-3">
                    <h2 class="fs-4">Filter by region:</h2>
                    <select id="region-filter" class="form-select" aria-label="Region-filter">
                        <option value="">All regions</option>
                        <option value="1">North</option>
                        <option value="2">Central</option>
                        <option value="3">East</option>
                        <option value="4">West</option>
                    </select>
                </div>
                <div class="filter-bar mb-3">
                    <h2 class="fs-5">Filter by ratings:</h2>
                    <select id="rating-filter" class="form-select" aria-label="rating-filter">
                        <option value="">All ratings</option>
                        <option value="1">1 star</option>
                        <option value="2">2 stars</option>
                        <option value="3">3 stars</option>
                        <option value="4">4 stars</option>
                        <option value="5">5 stars</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="row row-cols-1 row-cols-md-3 g-4" id="restaurants">
                    <!-- Restaurant divs go here -->
                </div>
            </div>
        </div>
    </div>
</section>
<section>

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
        // const restaurantsDiv = document.getElementById("restaurants");

        // Clear the existing restaurants from the div
        restaurantsDiv.innerHTML = "";

        // Loop through each restaurant
        for (let i = 0; i < restaurants.length; i++) {
            const restaurant = restaurants[i];
            restaurant.rating = `${restaurant.rating}`;
            restaurant.region = `${restaurant.region_id}`;
            let region = "";

            // Switch case for regions
            switch (restaurant.region){
                case '1':
                    region = "North";
                    break;
                case '2':
                    region = "Central";
                    break;
                case '3':
                    region = "East";
                    break;
                case '4':
                    region = "West";
                    break;
                default:
                    region = "Err";
                    break;
            }

            // Create the div for the restaurant
            const restaurantDiv = document.createElement("div");
            restaurantDiv.classList.add("col");
            restaurantDiv.classList.add("border");
            restaurantDiv.classList.add("border-2");
            restaurantDiv.classList.add("mx-1")
            restaurantDiv.id = `restaurant-${restaurant.id}`;

            // Generate the HTML for the restaurant's name with an <a> tag
            const restaurantNameHTML = `<h3><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/restaurants/${restaurant.id}">${restaurant.name}</a></h3>`;

            // Generate the HTML for the restaurant's description
            const restaurantDescHTML = `<p class="body-overlay">${restaurant.description}</p>`;

            // Generate the HTML for the restaurant's rating
            const starsHTML = '<div class="d-flex flex-row mb-3">' +
                '<div class="rating-stars p-2">' +
                '<span class="star">&#9733;</span>' +
                '<span class="star">&#9733;</span>' +
                '<span class="star">&#9733;</span>' +
                '<span class="star">&#9733;</span>' +
                '<span class="star">&#9733;</span>' +
                '</div>';

            const regionHTML = `<div class="p-2">Location : ${region}</div>`;

            const endHTML = '</div>';

            // Generate the HTML for the restaurant's image
            const restaurantImageHTML = `<img src="https://images.unsplash.com/photo-1528279027-68f0d7fce9f1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="${restaurant.name}" class="restaurant-image">`;

            // Add the rating stars, name, and image elements to the restaurant div
            restaurantDiv.innerHTML = restaurantNameHTML + starsHTML + regionHTML + endHTML + restaurantImageHTML;

            // Get the rating stars and image elements
            const ratingStars = restaurantDiv.querySelector('.rating-stars');
            const restaurantImage = restaurantDiv.querySelector('.restaurant-image');

            // Calculate the number of filled stars based on the rating value
            const filledStars = Math.floor(restaurant.rating);

            // Fill in the appropriate number of stars by adding the `.filled` class
            for (let i = 0; i < filledStars; i++) {
                ratingStars.children[i].classList.add('filled');
            }

            // If the rating is not a whole number, fill in the last partial star
            if (restaurant.rating % 1 > 0) {
                ratingStars.children[filledStars].innerHTML = '&#9733;&#189;';
                ratingStars.children[filledStars].classList.add('filled');
            }

            // Append the restaurant div to the restaurants div
            restaurantsDiv.appendChild(restaurantDiv);
        }
    }


    // // Region filter script
    // const regionFilter = document.getElementById('region-filter');
    // const filteredRestaurantsDiv = document.getElementById('filtered-restaurants');
    //
    // regionFilter.addEventListener('change', () => {
    //     const selectedRegion = regionFilter.value;
    //
    //     // If "All regions" is selected, show all restaurants
    //     if (selectedRegion === '') {
    //         displayRestaurants(restaurantInfoArr);
    //     } else {
    //         // Otherwise, filter the restaurants by the selected region
    //         const filteredRestaurants = restaurantInfoArr.filter((restaurant) => {
    //             return restaurant.region_id === selectedRegion;
    //         });
    //         displayRestaurants(filteredRestaurants);
    //         console.log(filteredRestaurants)
    //     }
    // });
    //
    // // Rating filter script
    // const ratingFilter = document.getElementById('rating-filter');
    //
    // ratingFilter.addEventListener('change', () =>{
    //     const selectedRating = ratingFilter.value;
    //
    //     // If "All ratings" is selected, show all restaurants
    //     if (selectedRating === ''){
    //         displayRestaurants(restaurantInfoArr);
    //     } else {
    //         // Otherwise, filter the restaurants by the ratings
    //         const filteredRestaurants = restaurantInfoArr.filter((restaurant) => {
    //             return restaurant.rating === selectedRating;
    //         });
    //         displayRestaurants(filteredRestaurants);
    //         console.log(filteredRestaurants)
    //     }
    // });

    const regionFilter = document.getElementById('region-filter');
    const ratingFilter = document.getElementById('rating-filter');
    const filteredRestaurantsDiv = document.getElementById('filtered-restaurants');

    function filterRestaurants() {
        const selectedRegion = regionFilter.value;
        const selectedRating = ratingFilter.value;

        let filteredRestaurants = restaurantInfoArr;

        // Apply the region filter if a region is selected
        if (selectedRegion !== '') {
            filteredRestaurants = filteredRestaurants.filter((restaurant) => {
                return restaurant.region_id === selectedRegion;
            });
        }

        // Apply the rating filter if a rating is selected
        if (selectedRating !== '') {
            filteredRestaurants = filteredRestaurants.filter((restaurant) => {
                return restaurant.rating === selectedRating;
            });
        }

        displayRestaurants(filteredRestaurants);
    }

    // Listen to changes on both filters
    regionFilter.addEventListener('change', filterRestaurants);
    ratingFilter.addEventListener('change', filterRestaurants);


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

    img {
        max-width: 100%;
        max-height: 100%;
    }

</style>

<?php include("views/template/Bottom.php"); ?>

