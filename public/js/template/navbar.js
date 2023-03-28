const navAuth = document.querySelector('#nav-auth');
const navDropdown = document.querySelector('#nav-dropdown');
const navUsername = document.querySelector('#nav-username');
const logoutBtn = document.querySelector('#logout-btn');

if (navAuth && navDropdown && navUsername && logoutBtn) {
    navAuth.style.setProperty('display', 'none', 'important');
    navDropdown.style.setProperty('display', 'none', 'important');

    // Every time user visits a page with a navbar, website checks if user is logged in to toggle top right corner elements.
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

    // Removes the HTTP only cookie from the client. Sounds silly having to need a Wi-Fi connection to logout, but that's how it works.
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

    const url = window.location.href;
    const page = url.split("/").pop();

    const navLinks = document.querySelector('#nav-links');
    const navigationLinks = navLinks.querySelectorAll('.nav-link');

    const pageIndices = {
        '': 0,
        'restaurants': 1,
        'about': 2,
        'contact': 3,
        'work': 4
    };
    navigationLinks[pageIndices[page]].classList.add("active");


}
