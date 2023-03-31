
let username = "";

function getName(callback) {
    fetch('/api/v1/auth/verify')
        .then(response => response.json())
        .then(data => {
            const {isVerified, username} = data.data;
            username.textContent = username;
            console.log(username);
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

