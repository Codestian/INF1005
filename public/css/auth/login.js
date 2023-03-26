const loginAlert = document.querySelector('#login-alert');

const loginEmail = document.querySelector('#login-email');
const loginPassword = document.querySelector('#login-password');

loginAlert.style.display = 'none';

document.querySelector("#login-form").addEventListener("submit", (e) => {
    e.preventDefault();

    const sanitizedEmail = loginEmail.value.trim();
    const sanitizedPassword = loginPassword.value.trim();

    fetch("/api/v1/auth/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            "email": sanitizedEmail,
            "password": sanitizedPassword
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status !== 200) {
                loginAlert.style.display = 'block';
                loginAlert.textContent = data.data.message;
            } else {
                alert("You are logged in. Welcome!");
                window.location.href = "/";
            }
        })
        .catch(error => {
            console.error(error);
            loginAlert.style.display = 'block';
            loginAlert.textContent = "Please try again";
        });
});

document.querySelector("#google-login").addEventListener("click", (e) => {
    e.preventDefault();
    fetch("/api/v1/auth/google/url")
        .then(response => response.json())
        .then(data => window.location.href = data.data.url)
        .catch(error => console.error(error));
})

document.querySelector("#apple-login").addEventListener("click", (e) => {
    e.preventDefault();
    alert('Apple Sign In not implemented. Requires $$$ :(');
})
