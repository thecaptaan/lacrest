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
    document.getElementById("contactForm").addEventListener("submit", (e) => {
        e.preventDefault();
        let data = {
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            message: document.getElementById("message").value
        };
       
        fetch("contact.php", {
            method: "POST",
            body: data
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    form.reset();
                } else {
                    let errorMessage = "Failed to send email. Please check the following errors:\n";
                    data.errors.forEach(function (error) {
                        errorMessage += error + "\n";
                    });
                    alert(errorMessage);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("An error occurred. Please try again later.");
            });
    });
});