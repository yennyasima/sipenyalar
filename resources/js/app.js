import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";

AOS.init();

$(document).scroll(function () {
    var $nav = $("#navbar");
    $nav.toggleClass("scrolled", $(this).scrollTop() > 50); // Adds 'scrolled' class when scrolled down 50px
});

window.addEventListener("load", () => {
    const preloader = document.querySelector("#preloader");
    if (preloader) {
        preloader.remove();
    }
});

window.Alpine = Alpine;

Alpine.start();
