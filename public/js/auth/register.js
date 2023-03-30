const registerAlert = document.querySelector('#register-alert');

const registerEmail = document.querySelector('#register-email');
const registerUsername = document.querySelector('#register-username');
const registerPassword = document.querySelector('#register-password');
const registerPasswordConfirm = document.querySelector('#register-password-confirm');

registerAlert.style.display = 'none';

document.querySelector("#register-form").addEventListener("submit", (e) => {
    e.preventDefault();
    // Sanitize and trim the input values
    const sanitizedEmail = registerEmail.value.trim();
    const sanitizedUsername = registerUsername.value.trim();
    const sanitizedPassword = registerPassword.value.trim();
    const sanitizedPasswordConfirm = registerPasswordConfirm.value.trim();

    if(sanitizedPassword === sanitizedPasswordConfirm) {
        fetch("/api/v1/auth/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                "email": sanitizedEmail,
                "username": sanitizedUsername,
                "password": sanitizedPassword
            }),
        })
            .then(response => response.json())
            .then(data => {
                if(data.status !== 200) {
                    registerAlert.style.display = 'block';
                    registerAlert.textContent = data.data.message;
                }
                else {
                    // User account creation successful, redirect user to home.
                    alert('Welcome! You can now login.');
                    window.location.href = "/login";
                }
            })
            .catch(error => {
                console.error(error);
            });
    }
    else {
        registerAlert.style.display = 'block';
        registerAlert.textContent = "Passwords do not match.";
    }

});