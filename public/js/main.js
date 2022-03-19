
// --------- Toggle Side Nav --------
const menuBtn = document.querySelector("#nav-toggle");
const sideNav = document.querySelector("#side-nav");

menuBtn.addEventListener("click", toggleSideNav);

function toggleSideNav() {
    if (sideNav.style.width == "5.6rem" || sideNav.style.width == "") {
        sideNav.style.width = "14rem";
    } else {
        // close side nav
        sideNav.style.width = "5.6rem";
        // close all opened sub menus
        document.querySelectorAll('.nav__drop').forEach(drop => drop.style.height = '0px');

    }
}
