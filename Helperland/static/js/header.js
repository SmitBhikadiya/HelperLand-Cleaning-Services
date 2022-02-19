
function showLoader(){
  $.LoadingOverlay("show",{
    background  : "rgba(0, 0, 0, 0.7)"
  });
}

$(document).ready(function () {
  $(".menu-bar").click(function () {
    $(".nav-list").toggleClass("active");
    $(".menu-bar i").toggleClass("active");
  });
  $(".sidebar-toggle").on("click", function () {
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

  setTimeout(toCheckSession, 1000);

  function toCheckSession() {
    if ($("#isLogin").val() != 0) {
      $.ajax({
        type: "POST",
        url: "http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=Users&function=CheckSession",
        datatype: "json",
        data: $("#addform").serialize(),
        success: function (data) {
          if (data == 1) {
            if(!$("#sessionexpired").hasClass('show')){
              $("#sessionexpired").modal("show");
            }
          }
        },
        complete:function(data){
            setTimeout(toCheckSession, 1000);
        }
      });    
    }
  }

  $("#sessionexpired .modal-footer button").on("click", function(){
    location.reload();
  });

  $('#sessionexpired').modal({
    backdrop: 'static',
    keyboard: false
  });
});
