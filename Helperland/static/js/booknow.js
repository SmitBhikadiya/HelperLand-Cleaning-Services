$(document).ready(function () {
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
  $("#ccvc").on("keyup", function(event){
    var cvc = $(this).val();
    if (event.which >= 48 && event.which <= 57) {
        if (!cvc.length <= 3) {
            $(this).val(cvc.substring(0, 3));    
        }
      } else {
        $(this).val(cvc.substring(0, cvc.length - 1));
      }
  });
});
