// document.addEventListener("contextmenu", function (e) {
//     e.preventDefault();
// });
const originalBody = document.body.cloneNode(true);

// function checkConsole() {
//     if (window.outerWidth - window.innerWidth > 200 || window.outerHeight - window.innerHeight > 200) {
//         // Console is open, remove body
//         document.body.remove();
//     } else {
//         // Console is closed, restore body
//         document.documentElement.replaceChild(originalBody, document.body);
//     }
// }

// Check console status periodically
// setInterval(checkConsole, 1000);
document.addEventListener('DOMContentLoaded', () => {
    let hamburger = document.getElementById("hamburger");
    let navList = document.querySelector(".nav__list");
    let navContainer = document.querySelector(".nav__links__container")
    let navItem = document.querySelectorAll(".nav__item");
    hamburger.addEventListener("click", () => {
        navContainer.classList.toggle("hamburger__position");
        navList.classList.toggle("hamburger__show");
        hamburger.src = navList.classList.contains("hamburger__show") ? "./images/cancel.svg" : "./images/hamburger.svg";
    });
    navItem.forEach(item => {
        item.addEventListener("click", () => {
            navContainer.classList.remove("hamburger__position");
            navList.classList.remove("hamburger__show");
            hamburger.src = "./images/hamburger.svg";
        });
    });
});