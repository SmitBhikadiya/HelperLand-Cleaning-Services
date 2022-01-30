
$(document).ready(function () {
  $(".menu-bar").click(function () {
    $(".nav-list").toggleClass("active");
    $(".menu-bar i").toggleClass("active");
  });
  $(".sidebar-toggle").on("click",function(){
    $(".div-sidebar").toggleClass("toggle");
    $(".sidebar-toggle i").toggleClass("toggle");
  });
  if (window.scrollY > 30) {
    $(".navbar").addClass("sticky");
  } else {
    $(".navbar").removeClass("sticky");
  }
  $(window).scroll(function () {
    if (this.scrollY > 30) {
      $(".navbar").addClass("sticky");
      $(".div-sidebar").addClass("sticky");
    } else {
      $(".navbar").removeClass("sticky");
      $(".div-sidebar").removeClass("sticky");
    }
  });
});

