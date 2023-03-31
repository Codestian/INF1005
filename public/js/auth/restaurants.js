
const registerEmail = document.querySelector('#register-email');
const registerUsername = document.querySelector('#register-username');
const registerPassword = document.querySelector('#register-password');
const registerPasswordConfirm = document.querySelector('#register-password-confirm');

const restaurantName = document.querySelector('#restaurant-name');
const restaurantContact = document.querySelector('#restaurant-contact');
const restaurantOpenHours = document.querySelector('#restaurant-openinghour');
const restaurantCloseHours = document.querySelector('#restaurant-closinghour');
const restaurantAddress = document.querySelector('#restaurant-address');
const restaurantPricing = document.querySelector('#restaurant-pricing');
const restaurantCuisine = document.querySelector('#restaurant-cuisine');
const restaurantRegion = document.querySelector('#restaurant-region');
const restaurantDescription = document.querySelector('#restaurant-description');



document.querySelector("#restaurant-signup").addEventListener("submit", (e) => {
    e.preventDefault();
    // Sanitize and trim the input values
    const sanitizedEmail = registerEmail.value.trim();
    const sanitizedUsername = registerUsername.value.trim();
    const sanitizedPassword = registerPassword.value.trim();
    const sanitizedPasswordConfirm = registerPasswordConfirm.value.trim();

    const sanitizedRestName = restaurantName.value.trim();
    const sanitizedRestOpenHours = restaurantOpenHours.value.trim();
    const sanitizedRestCloseHours = restaurantCloseHours.value.trim();
    const sanitizedRestAddress = restaurantAddress.value.trim();
    const sanitizedRestPricing = restaurantPricing.value.trim();
    const sanitizedRestCuisine = restaurantCuisine.value.trim();
    const sanitizedRestRegion = restaurantRegion.value.trim();
    const sanitizedRestDesc = restaurantDescription.value.trim();

    if(sanitizedPassword === sanitizedPasswordConfirm) {
        fetch("/api/v1/auth/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                "email": sanitizedEmail,
                "username": sanitizedUsername,
                "password": sanitizedPassword,
                "role_id" : 3
            }),
        })
            .then(response => response.json())
            .then(data => {
                if(data.status !== 200) {
                    console.log("Failure");
                }
                else {
                    // User account creation successful, redirect user to home.
                    alert('Welcome! You can now add restaurant items!.');
                    window.location.href = "/";
                }
            })
            .catch(error => {
                console.error(error);
            });

        fetch("/api/v1/restaurants", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body : JSON.stringify({
                "name" : sanitizedRestName,
                "description" : sanitizedRestDesc,
                "address" : sanitizedRestAddress,
                "rating" : "1",
                "opening_hours" : sanitizedRestOpenHours,
                "closing_hours" : sanitizedRestCloseHours,
                "estimated_price" : sanitizedRestPricing,
                "cuisine_id" : sanitizedRestCuisine,
                "region_id" : sanitizedRestRegion
            })
        })
            .then(response => response.json())
            .then(data => {
                alert('Success: ' + data.data.message);
            })
            .catch((error) => {
                alert('Error: ' + error);
                console.error('Error:', error);
            });
    }
    else {
        // registerAlert.style.display = 'block';
        // registerAlert.textContent = "Passwords do not match.";
    }

});