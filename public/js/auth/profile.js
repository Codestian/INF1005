
let username = "";
let role = "";

function getName(callback) {
    fetch('/api/v1/auth/verify')
        .then(response => response.json())
        .then(data => {
            const {isVerified, username, id, role_id} = data.data;
            username.textContent = username;
            role_id.textContent = role_id;
            console.log(username);
            console.log(role_id);

            if (role_id === "3" || role_id === "1") {
                const card = document.createElement('div');
                card.classList.add('card');
                card.classList.add('shadow');
                card.classList.add('mt-3');
                card.innerHTML = `
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Add Restaurants Items!</p>
                    </div>
                    <div class="card-body">
                        <p>To add items into your Restaurant. Click on the Add Items button below!</p>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#itemModal">Add Items</button>
                    </div>
                `;
                document.querySelector('.col-lg-8').appendChild(card);
            }

            callback(username);
        })
        .catch(err => {
            console.log(err)
        })
}


function callName(username) {
    document.getElementById("welcome").innerHTML = "Welcome Back! " + username;
}
getName(callName);

// Functions for changing profile picture.
document.getElementById('button-file').addEventListener('click', openDialog);

function openDialog() {
    document.getElementById('my-file').click();
}

document.getElementById("my-file").onchange = function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            // e.target.result is a base64-encoded url that contains the image data
            document.getElementById('profile-pic').setAttribute('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    }
}
const restaurantSelect = document.getElementById('restaurant');
let restaurantArr = [];

fetch('/api/v1/restaurants')
    .then(response => response.json())
    .then(data => {
        if (data.status === 200) {
            restaurantArr = data.data;
            console.log(restaurantArr)
            restaurantArr.forEach(restaurant => {
                const option = document.createElement('option');
                option.value = restaurant.id;
                option.text = restaurant.name;
                restaurantSelect.appendChild(option);
            });
        }
    })
    .catch(error => {
        console.error(error);
    });

const restItem = document.querySelector('#res-item');
const restDesc = document.querySelector('#res-item-desc');
const restPrice = document.querySelector('#rest-item-price');
const restID = document.querySelector('#restaurant');
document.querySelector('#add-item').addEventListener("submit", (e) =>{
    e.preventDefault();

    const sanitizeRestItem = restItem.value.trim();
    const sanitizeRestDesc = restDesc.value.trim();
    const sanitizeRestPrice = restPrice.value.trim();
    const sanitizeRestID = restID.value.trim();

    fetch('/api/v1/items', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            "name": sanitizeRestItem,
            "description": sanitizeRestDesc,
            "price": sanitizeRestPrice,
            "restaurant_id" : sanitizeRestID
        })
    })
        .then(response => response.json())
        .then(data => {
            if(data.status !== 200) {
                console.log("Failure");
            }
            else {
                // User account creation successful, redirect user to home.
                alert('Congrats! Item has been added!');
                console.log("Success");
                window.location.href = "/";
            }
        })
        .catch(error => {
            console.error(error);
        });
});


