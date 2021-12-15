$(document).ready(function () {
    $(".div-sidebar .nav-tog").on("click", function () {
        if (!$(this).hasClass("active-nav")) {
            const navtags = document.getElementsByClassName("nav-tog");
            for (var i = 0; i < navtags.length; i++) {
                navtags[i].classList.remove("active-nav");
            }
            $(this).addClass("active-nav");
            //alert("add");
        } else {
            //alert("remove");
            $(this).removeClass("active-nav");
        }
    });
    $(".div-sidebar a").on("click", function () {
        //alert($(this).hasClass("sidebar-active"));
        if (!$(this).find("sidebar-active").length) {
            const active = document.getElementsByClassName("sidebar-active");
            for (var i = 0; i < active.length; i++) {
                active[i].classList.remove("sidebar-active");
            }
            $(this).addClass("sidebar-active");
          //  alert("add");
        } else {
            //alert("remove");
            $(this).removeClass("sidebar-active");
        }
    });
}); 