const url = window.location.href;
const page = url.split("/").pop();
const navigationLinks = document.querySelectorAll('.nav-link');

const pageIndices = {
    '/': 0,
    'restaurants': 1,
    'roles': 2,
    'items': 3,
    'reviews': 4,
    'reservations': 5,
    'users': 6,
    'regions': 7,
    'providers': 8
};
navigationLinks[pageIndices[page]].classList.add("active");