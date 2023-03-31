
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

            if (role_id === "3") {
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
                        <button class="btn btn-primary" type="button">Add Items</button>
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

