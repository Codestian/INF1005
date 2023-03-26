const navAuth = document.querySelector('#nav-auth');
const navDropdown = document.querySelector('#nav-dropdown');
const navUsername = document.querySelector('#nav-username');
const logoutBtn = document.querySelector('#logout-btn');

if (navAuth && navDropdown && navUsername && logoutBtn) {
    navAuth.style.setProperty('display', 'none', 'important');
    navDropdown.style.setProperty('display', 'none', 'important');

    fetch('/api/v1/auth/verify')
        .then(response => response.json())
        .then(data => {
            const { isVerified, username } = data.data;
            console.log(data.data);
            if(isVerified) {
                navDropdown.style.setProperty('display', 'flex', 'important');
            }
            else {
                navAuth.style.setProperty('display', 'block', 'important');
            }
            navUsername.textContent = username;
        })
        .catch(err => {
            console.log(err)
        })

    logoutBtn.addEventListener('click', () => {
        fetch('/api/v1/auth/logout')
            .then(response => response.json())
            .then(data => {
                window.location.href = "/";
            })
            .catch(err => {
                console.log(err)
            })
    })
}
