
/**
 * Template Name: Moderna
 * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
 * Updated: Mar 17 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

document.addEventListener("DOMContentLoaded", function() {
    const banner = document.getElementById("banner")
    const loginContainer = document.getElementById("login-container")
    const signupContainer = document.getElementById("signup-container")
    const loginToggle = document.getElementById("login-form-toggler")
    const signupToggle = document.getElementById("signup-form-toggler")

    signupToggle.addEventListener('click', () => {
        banner.style.transform = "translateX(-100%)";
        loginContainer.style.transform = "scale(0)";
        signupContainer.style.transform = "scale(1)"
    })
    loginToggle.addEventListener('click', () => {
        banner.style.transform = "translateX(0%)"
        signupContainer.style.transform = "scale(0)"
        loginContainer.style.transform = "scale(1)"
    })
});
