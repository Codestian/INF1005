const loadingContainer = document.querySelector('#loading-container');
const registerForm = document.querySelector('#register-form');
const registerUsername = document.querySelector('#register-username');
const registerButton = document.querySelector('#register-button');

registerForm.style.display = 'none';

const urlParams = new URLSearchParams(window.location.search);

// Retrieve a specific query parameter
const paramValue = urlParams.get('code');

if(paramValue) {
    //  Calls API to verify the redirect params Google passed in to url.
    fetch("/api/v1/auth/google/login?code=" + paramValue)
        .then(response => response.json())
        .then(data => {
            if(!data.data.isRegistered) {
                registerUsername.value = data.data.username;
                registerForm.style.display = 'block';
                loadingContainer.style.display = 'none';
            }
            else {
                window.location.href = "/";
            }
        })
        .catch(error => console.error(error));

    registerButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = "/";
        console.log('continue to website');
    });
}
