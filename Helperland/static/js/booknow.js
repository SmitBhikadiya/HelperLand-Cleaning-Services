$(document).ready(function () {
  window.today = getTodayDate();

  //remove sticky class
  if (window.scrollY > 30) {
    $(".navbar").removeClass("sticky");
  }
  $(window).scroll(function () {
    if (this.scrollY > 30) {
      $(".navbar").removeClass("sticky");
    }
  });

  //card number validation
  $("#cnumber").on("keyup", function (event) {
    var value = $(this).val();
    if (value.length <= 17) {
      if (event.which >= 48 && event.which <= 57) {
        var temp = value.replace(/\s/g, "");
        var len = temp.length;
        if (len % 4 == 0) {
          $(this).val(value + " ");
          flag = 1;
        }
      } else {
        $(this).val(value.substring(0, value.length - 1));
      }
    } else {
      $(this).val(value.substring(0, 18));
      return false;
    }
  });

  //card date validation
  $("#cmonth").on("keyup", function (event) {
    var date = $(this).val();
    if (date.length <= 5) {
      if (event.which >= 48 && event.which <= 57) {
        if (date.length == 2) {
          $(this).val(date + "/");
        }
      } else {
        $(this).val(date.substring(0, date.length - 1));
      }
    } else {
      $(this).val(date.substring(0, 5));
      return false;
    }
  });

  //card cvc validation
  $("#ccvc").on("keyup", function (event) {
    var cvc = $(this).val();
    if (event.which >= 48 && event.which <= 57) {
      if (!cvc.length <= 3) {
        $(this).val(cvc.substring(0, 3));
      }
    } else {
      $(this).val(cvc.substring(0, cvc.length - 1));
    }
  });

  // close modal when window size will below 1200px
  $(window).resize(function () {
    if ($(window).width() < 1200) {
      $("#examplePaymentSummary").modal("hide");
    }
  });

  // remove address button when click and added when cancel
  var address_btn = null;
  $(document).on("click", ".new-address-button button", function () {
    address_btn = $(this).parent().html();
    $(this).remove();
  });
  $(document).on("click", ".btn-cancel", function () {
    if (address_btn != null) {
      $(".new-address-button").html(address_btn);
      address_btn = null;
    }
  });

  // when click on nav-tabs
  $(".nav-link").on("click", function () {
    var navtabs = [
      "bookstep-setup",
      "bookstep-schedule",
      "bookstep-detailes",
      "bookstep-payment",
    ];
    for (var i = 0; i < navtabs.length; i++) {
      if (!$(this).is($("." + navtabs[i]))) {
        //alert(i+" "+navtabs.indexOf(this.className.split(" ")[0]));
        if (i >= navtabs.indexOf(this.className.split(" ")[0])) {
          $("." + navtabs[i]).removeClass("filled");
        }
      }
    }
    setClickableOnNavTabs();
  });

  $(".form-check-label").on("click", function(){
    var radiolist = document.getElementById("fav-sp-list").getElementsByClassName("favspradio");
    for(i=0;i<radiolist.length;i++){
      radiolist[i].querySelector(".user-select").innerHTML = "Select";
      radiolist[i].querySelector(".user-select").classList.remove("selected");
    }
    if(!$(this).parent().find(".form-check-input:checked").val()){
      $(this).find(".user-select").text("Selected");
      $(this).find(".user-select").addClass("selected");
    }
    //$(this).find(".user-select").text("selected");
  });

  //when payment-summary-button clicked
  $(".payment-summary-button").on("click", function () {
    var payment_content = $(".side-payment-bar").html();
    var modal_body = $("#examplePaymentSummary .modal-content .modal-body");
    modal_body.html(payment_content);
    modal_body.find(".payment-header").remove();
  });

  $("#savenewaddress").on("click",function(e){
    var streetname = $("#streetname").val();
    var housenumber = $("#housenumber").val();
    var phonenumber = $("#phonenumber").val();
    var reg = /^[\d]{10}$/;
    if(!(streetname.length < 1 || housenumber.length < 1 || phonenumber.length < 1 || !reg.test(phonenumber))){
      // store address through ajax
    }else{
      alert("Invalid input or empty field can`t accept");
    }
    e.preventDefault();
  });

  // For Payment Summary
  $(document).on("click", "#step1_submit", function (e) {
    // validate step 1
    var postalcode = $("#postalcode").val();
    $(".error").remove();
    if (isValidPostalCode(postalcode)) {
      // ajax to check whether postal code is valid or not
      var action = $("#form-setup").attr("action");
      jQuery.ajax({
        type:"POST",
        url:action,
        datatype:"json",
        data:$("#form-setup").serialize(),
        success: function(data){
          var obj = JSON.parse(data);
          if(obj.errors.length==0){
            swithcTheTab("bookstep-setup", "bookstep-schedule", "nav-setup", "nav-schedule");
            setClickableOnNavTabs();
            setFormDefaultValue();
          }else{
            $("#postalcode").parent().after("<span class='error'>"+obj.errors.ZipCode+"</span>");
          }
          return true;
        }
      });
    }
    e.preventDefault();
  });

  $(document).on("click", "#step2_submit", function (e) {
    if (window.form2error) {
      UpdatePaymentSummary();
    } else {

      $.ajax({
        type:"POST",
        url:"http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=BookNow&function=isLogin",
        success: function(isLogin){
          if(Boolean(isLogin)){
            alert("Yahh");
          }
        }
      });

      swithcTheTab("bookstep-schedule", "bookstep-detailes", "nav-schedule", "nav-detailes");
      setClickableOnNavTabs();
    }
    e.preventDefault();
  });
  $(document).on("click", "#step3_submit", function (e) {
    var addClasses = document.getElementById("detailes-address").getElementsByClassName("form-check-input");
    var flag = false;
    $(".form-detailes .alert").remove();
    for (var i = 0; i < addClasses.length; i++) {
      if (addClasses[i].checked) {
        flag = true;
      }
    }

    if (flag) {
      swithcTheTab("bookstep-detailes", "bookstep-payment", "nav-detailes", "nav-payment");
      setClickableOnNavTabs();
    } else {
      $(".form-detailes").prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert">Please select address!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
    e.preventDefault();
  });
  $("#step4_submit").on("click", function (e) {
    if($("#booknowpolicy").is(":checked")){
      alert(0);
    }else{
      alert("Accept the policy");
    }
    e.preventDefault();
  });

  // form 2 onchange events
  $(document).on("change", "#service-date", function () {
    UpdatePaymentSummary();
  });
  $(document).on("change", "#service-time", function () {
    UpdatePaymentSummary();
  });
  $(document).on("change", "#service-hour", function () {
    UpdatePaymentSummary();
  });

  window.extratime = 0;
  $(".extra-div .form-check-label").on("click", function () {
    // set extra service
    var extraname = $(this).find(".extra-title").text();
    var extraid = $(this).find(".extra-title").prop("id");
    var extramin = "30 Min";
    var extradiv =
      '<div class="extra ' +
      extraid +
      '" ><div class="title">' +
      extraname +
      '</div><div class="total">' +
      extramin +
      "</div></div>";
    if (!$(this).parent().find("input").is(":checked")) {
      $(".payment-extras").append(extradiv);
      window.extratime += 0.5;
    } else {
      $(".payment-extras ." + extraid).remove();
      window.extratime -= 0.5;
    }
    UpdatePaymentSummary();
  });

  function UpdatePaymentSummary() {
    window.form2error = 0;
    
    // update service date
    var changedate = new Date($("#service-date").val());
    var today = new Date(window.today);
    //alert(changedate.getTime()+" "+ today.getTime());
    if (changedate.getTime() >= today.getTime()) {
      var date = changedate.getFullYear() + "-" + ("0" + (changedate.getMonth() + 1)).slice(-2) + "-" + ("0" + changedate.getDate()).slice(-2);
      $(".duration-date").text(date);
    } else {
      $("#service-date").val(window.today);
      var date = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ("0" + today.getDate()).slice(-2);
      $(".duration-date").text(date);
      alert("Your input must be equal or bigger than today's date");
      window.form2error = 1;
    }

    // gwt service time and basic hour
    var time = +$("#service-time").val();
    window.hour = +$("#service-hour").val();
    $(".error").remove();
    if (time + window.hour + window.extratime > 21) {
      $(".schedule-timing").after("<p class='error'>Could not completed the service request, because service booking request is must be completed within 21:00 time</>");
      window.form2error = 1;
    } else {
      $(".duration-time").text(
        $("#service-time option[value='" + time + "']").text()
      );
      $(".duration-basic .total").text(
        $("#service-hour option[value='" + window.hour + "']").text()
      );
    }

    // update total service time, per cleaning and total payment
    $(".total-service-time .total").text(
      window.extratime + window.hour + " Hrs."
    );
    $(".per-cleaning .total").text(
      (window.extratime + window.hour) * 18 + ",00 €"
    );
    $(".total-payment .total").text(
      (window.extratime + window.hour) * 18 + ",00 €"
    );
  }

  function setClickableOnNavTabs() {
    var clslist = document
      .getElementById("nav-tab")
      .getElementsByClassName("nav-link");
    for (var i = 0; i < clslist.length; i++) {
      if (clslist[i].classList.contains("filled")) {
        clslist[i].style.pointerEvents = "auto";
      } else {
        clslist[i].style.pointerEvents = "none";
      }
    }
  }
  function setFormDefaultValue() {
    var service_start_at = "8";
    var working_hour = "3";
    var total_payment = "54";
    var default_extra = '<div class="extras-title">Extras</div><div class="extra"><div class="title"></div><div class="total"></div></div>';

    // set default value on form of step2
    $("#service-date").val(window.today);
    $("#service-time").val(service_start_at).change();
    $("#service-hour").val(working_hour).change();
    $(".extra-div input:checkbox").prop("checked", false);
    $("#comments").val("");
    $("#petathome").prop("checked", false);

    // get default value from form of step2

    //set default value for payment summary
    $(".duration-date").text(window.today);
    $(".duration-time").text(
      $("#service-time option[value='" + service_start_at + "']").text()
    );
    $(".duration-basic .total").text(
      $("#service-hour option[value='" + working_hour + "']").text()
    );
    $(".payment-extras").html(default_extra);
    $(".total-service-time .total").text(
      $("#service-hour option[value='" + working_hour + "']").text()
    );
    $(".per-cleaning .total").text(total_payment + ",00 €");
    $(".total-payment .total").text(total_payment + ",00 €");
  }

  function getTodayDate() {
    var myDate = new Date();
    var dt = myDate.getFullYear() + "-" + ("0" + (myDate.getMonth() + 1)).slice(-2) + "-" + ("0" + myDate.getDate()).slice(-2);
    return dt;
  }

  function isValidPostalCode(postal) {
    var len = postal.length;
    if (len <= 0) {
      $("#postalcode").parent().after("<span class='error'>Field can`t be empty</span>");
      return false;
    } else if (len != 5) {
      $("#postalcode").parent().after("<span class='error'>Postal code must be 5 characters long</span>");
      return false;
    } else {
      return true;
    }
  }

  function swithcTheTab(from1, to1, from2, to2) {
    // from 1
    $("." + from1).addClass("filled");
    $("." + from1).removeClass("active");
    $("." + from1 + ".filled").attr("aria-selected", "false");
    $("#" + from2).removeClass("show active");

    // from 2
    $("." + to1).addClass("active");
    $("." + to1 + ".active").attr("aria-selected", "true");
    $("#" + to2).addClass("show active");
  }
});
