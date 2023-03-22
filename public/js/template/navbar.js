const navAuth = document.querySelector('#nav-auth');
const navDropdown = document.querySelector('#nav-dropdown');

const isLoggedIn = false;

if(navAuth && navDropdown) {
    navAuth.style.display = 'none';
    navDropdown.style.display = 'none';
    if(isLoggedIn) {
        navDropdown.style.display = 'block';
    }
    else {
        navAuth.style.display = 'block';
    }
}
