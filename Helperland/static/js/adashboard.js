$(document).ready(function () {
    $(".div-sidebar .nav-tog p").on("click", function () {
        if (!$(this).parent().hasClass("active-nav")) {
            const navtags = document.getElementsByClassName("nav-tog");
            for (var i = 0; i < navtags.length; i++) {
                navtags[i].classList.remove("active-nav");
            }
            $(this).parent().addClass("active-nav");
        } else {
            $(this).parent().removeClass("active-nav");
        }
    });
    $(".div-sidebar a").on("click", function () {
        if (!$(this).find("sidebar-active").length) {
            const active = document.getElementsByClassName("sidebar-active");
            for (var i = 0; i < active.length; i++) {
                active[i].classList.remove("sidebar-active");
            }
            $(this).addClass("sidebar-active");
        } else {
            $(this).removeClass("sidebar-active");
        }
    });
}); 