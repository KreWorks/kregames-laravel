/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav()
{
    document.getElementById("open-btn").style.display = "none";
    document.getElementById("close-btn").style.display = "block";
    toggleDisplay(document.getElementById("page-name"), "block");
    document.getElementById("menu").style.width = "300px";
    document.getElementById("main").style.marginLeft = "300px";

    var links = document.querySelectorAll(".menu-item-link");
    links.forEach((link) =>
    {
        toggleDisplay(link);
    });
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav()
{
    document.getElementById("open-btn").style.display = "block";
    document.getElementById("close-btn").style.display = "none";
    toggleDisplay(document.getElementById("page-name"));
    document.getElementById("menu").style.width = "80px";
    document.getElementById("main").style.marginLeft = "80px";

    var links = document.querySelectorAll(".menu-item-link");
    links.forEach((link) =>
    {
        toggleDisplay(link);
    })
}

function loadPage()
{
    document.getElementById("open-btn").style.display = "none";
    /*
    var links = document.querySelectorAll(".menu-item-link");
    links.forEach((link) =>
    {
        toggleDisplay(link);
    })*/
}

function toggleDisplay(element, show = 'inline')
{
    if (element.style.display == 'none') {
        element.style.display = show;
    } else {
        element.style.display = 'none';
    }
}



/*!
* Start Bootstrap - Resume v7.0.4 (https://startbootstrap.com/theme/resume)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-resume/blob/master/LICENSE)
*/
//
// Scripts
// 
/*
window.addEventListener('DOMContentLoaded', event => {

    // Activate Bootstrap scrollspy on the main nav element
    const sideNav = document.body.querySelector('#sideNav');
    if (sideNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#sideNav',
            offset: 74,
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});
*/