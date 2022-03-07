$(document).ready(function () {
  // for avtar selection
  $(document).on("click", "#avatars img", function (e) {
    $("#avatars img").removeClass("selected");
    $(this).addClass("selected");
    var imgname = $(this).prop("alt");
    $(".account-header img").prop(
      "src",
      "./static/images/avtar/" + imgname + ".png"
    );
    $(".account-header img").prop("alt", imgname);
  });

  //
  $(document).on("keyup", "#phonenumber", function(){
    var mobile = $(this).val();
    $("#add-mobile").val(mobile);
  });

  // save setting tab user detailes
  $(document).on("click", "#servicersave", function (e) {
    e.preventDefault();
    if($(this).parent().find('.error').length==0){
      var action = $(this).parent().prop("action");
      var avtar = $("#avatars img.selected").prop("alt");
      var data = $(this).parent().serialize() + "&profilepicture=" + avtar;
      jQuery.ajax({
        type: "POST",
        url: action,
        datatype: "json",
        data: data,
        success: function (data) {
          console.log(data);
          var obj = JSON.parse(data);
          if (obj.errors.length == 0) {
            $("#firstname").val(obj.result.FirstName);
            $(".header-image span").text(obj.result.FirstName);
            $("#lastname").val(obj.result.LastName);
            $("#phonenumber").val(obj.result.Mobile);
            $("#email").val(obj.result.Email);
            if (obj.result.DateOfBirth == null) {
              var date = new Date("Y-m-d", obj.result.DateOfBirth);
              $("#birthdate").val(date);
            }
            if (obj.addid != 0) {
              $("#addid").val(obj.addid);
            }
            $("#form-usersave").prepend(
              '<div class="alert alert-success alert-dismissible fade show" role="alert"><ul class="success">user saved Successfully!!</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
            );
          } else {
            var errorlist = "";
            for (const [key, val] of Object.entries(obj.errors)) {
              errorlist += `<li>${val}</li>`;
            }
            $("#form-usersave").prepend(
              '<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="error">' +
                errorlist +
                '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
            );
          }
        },
        complete: function (data) {
          $.LoadingOverlay("hide");
        },
      });
    }
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#nav-tab").offset().top,
      },100);
  });

  $(document).on("keyup", "#add-postal", function (e) {
    var postal = $(this).val();
    if (postal.length == 5) {
      $(".error").remove();
      showLoader();
      jQuery.ajax({
        type: "POST",
        url: "http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=Users&function=getCityByPostal",
        datatype: "json",
        data: { postalcode: postal },
        success: function (data) {
          var obj = JSON.parse(data);
          if (obj.errors.length == 0) {
            var option =
              "<option value=" +
              obj.result.CityName.toLowerCase() +
              " selected>" +
              obj.result.CityName +
              "</option>";
            $("#city").html(option);
          } else {
            $("#city").html("");
            $("#add-postal").after(
              "<span class='error'>*invalid postal code</span>"
            );
          }
        },
        complete: function (data) {
          $.LoadingOverlay("hide");
        },
      });
    } else {
      $("#city").html("");
      $.LoadingOverlay("hide");
    }
  });

  // when user want to update password
  $(document).on("click", "#btn-updatepassword", function(e){
    e.preventDefault();
    if($(this).parent().parent().find('.error').length==0){
      var action = $(this).parent().parent().prop("action");
      showLoader();
      jQuery.ajax({
        type: "POST",
        url: action,
        datatype: "json",
        data: $("#form-changepassword").serialize(),
        success: function (data) {
          console.log(data);
          var obj = JSON.parse(data);
          if(obj.errors.length==0){
            $("#form-changepassword").prepend('<div class="alert alert-success alert-dismissible fade show" role="alert"><ul class="success">Password Changed Successfully!!</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
          }else{
            var errorlist = "";
            for (const [key, val] of Object.entries(obj.errors)) {
              errorlist += `<li>${val}</li>`;
            }
            $("#form-changepassword").prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="errorlist">' +errorlist +'</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
          }
          $("#form-changepassword").trigger("reset");
        },
        complete: function (data) {
          $.LoadingOverlay("hide");
        },
      });
    }
  });

});
