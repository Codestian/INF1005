const url = window.location.href;
const page = url.split("/").pop();
const navigationLinks = document.querySelectorAll('.nav-link');

const pageIndices = {
    '/': 0,
    'restaurants': 1,
    'roles': 2,
    'items': 3,
    'users': 4
};
navigationLinks[pageIndices[page]].classList.add("active");