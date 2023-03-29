document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.querySelector('form');
    const emailInput = document.querySelector('#login-email');
    const passwordInput = document.querySelector('#login-password');
    const rememberMeCheckbox = document.querySelector('#remember-me');

    // Retrieve "remember me" value from localStorage on page load
    const rememberMe = localStorage.getItem('rememberMe') === 'true';
    if (rememberMe) {
        emailInput.value = localStorage.getItem('email');
        passwordInput.value = localStorage.getItem('password');
        rememberMeCheckbox.checked = true;
    }

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const email = emailInput.value;
        const password = passwordInput.value;
        const rememberMe = rememberMeCheckbox.checked;

        // Save "remember me" value to localStorage
        if (rememberMe) {
            localStorage.setItem('email', email);
            localStorage.setItem('password', password);
            localStorage.setItem('rememberMe', true);
        } else {
            localStorage.removeItem('email');
            localStorage.removeItem('password');
            localStorage.removeItem('rememberMe');
        }

        // Make API call with email and password
        const response = await fetch('/api/v1/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });

        // Handle response
        const data = await response.json();
        if (response.ok) {
            // Redirect to new page
            window.location.href = 'http://choppy.codestian.com/admin/dashboard';
        } else {
            // Display error message
            console.log(data.error);
        }
    });
});
