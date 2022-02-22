$(document).ready(function () {

  // daclare today date
  var today = new Date();
  today.setDate(today.getDate()+1);
  var tommorrow = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ("0" + today.getDate()).slice(-2);
  
  var currentpage = 1; // current page number
  var showrecords = $(".show-apge select").val(); // total records shown in select input
  var totalrecords = getDefaultRecords();
  var totalpage = Math.ceil(totalrecords / showrecords);
  var records = [];
  totalpage = totalpage == 0 ? 1 : totalpage;
  getAjaxDataByReq();

  $(document).on("change", ".show-apge select", function () {
    showrecords = $(this).val();
    totalpage = Math.ceil(totalrecords / showrecords);
    totalpage = totalpage == 0 ? 1 : totalpage;
    updatePageNumber(currentpage);
  });

  $(document).on("click", ".paginations div", function () {
    var actionclass = $(this).prop("class");
    switch (actionclass) {
      case "jump-left":
        currentpage = 1;
        break;
      case "next-left":
        if (currentpage > 1) {
          currentpage--;
        }
        break;
      case "next-right":
        if (currentpage < totalpage) {
          currentpage++;
        }
        break;
      case "jump-right":
        currentpage = totalpage;
        break;
    }
    updatePageNumber(currentpage);
    getAjaxDataByReq();
  });

  $(document).on("click", ".btn-reschedule", function () {
    $(".alert").remove();
    var index = $(this).parent().parent().prop("id").split("_")[1];
    var result = records[index];
    $("#exampleModalServiceReschedule .modal-body .reschedule_sid").val(result.ServiceRequestId);
    $("#exampleModalServiceReschedule .modal-body .reschedule_servicehour").val(result.ServiceHours);
    $("#exampleModalServiceReschedule .modal-body input[type=date]").val(tommorrow);
    $("#exampleModalServiceReschedule .modal-body input[type=date]").prop("min",tommorrow);
  });

  $(document).on('click',"#reschedule_update", function(e){
    showLoader();
    e.preventDefault();
    $(".alert").remove();
    var action = $(this).parent().prop("action");
    jQuery.ajax({
      type: "POST",
      url: action,
      datatype: "json",
      data: $("#form-reschedule").serialize(),
      success: function (data) {
        console.log(data);
        var obj = JSON.parse(data);
        if(obj.errors.length==0){
            $("#form-reschedule").prepend('<div class="alert alert-success alert-dismissible fade show" role="alert"><ul class="success">Service rescheduled Successfully!!</ul></div>');
            getAjaxDataByReq();
        }else{
            var errorlist = "";
            for (const [key, val] of Object.entries(obj.errors)) {
                errorlist+=`<li>${val}</li>`
            }
            $("#form-reschedule").prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="errorlist">'+errorlist+'</ul></div>');
        }
      },
      complete: function (data) {
        $.LoadingOverlay("hide");
      },
    });
  });

  $(document).on("click", ".btn-cancel", function () {
    var serviceid = +$(this).parent().parent().find(".serviceid").text();
    $("#exampleModalServiceCancel .modal-body input[type=hidden]").val(
      serviceid
    );
  });

  $(document).on("click", ".sreschedule", function (e) {
    $(".alert").remove();
    e.preventDefault();
    var serviceid = +$(this).parent().parent().parent().find(".sid").text();
    $("#exampleModalServiceReschedule .modal-body input[type=hidden]").val(
      serviceid
    );
  });

  $(document).on("click", ".scancel", function (e) {
    e.preventDefault();
    var serviceid = +$(this).parent().parent().parent().find(".sid").text();
    $("#exampleModalServiceCancel .modal-body input[type=hidden]").val(
      serviceid
    );
  });

  $(document).on("click", ".show_detailes", function () {
    var index = $(this).parent().prop("id").split("_")[1];
    var result = records[index];
    var date = getTimeAndDate(result.ServiceStartDate, result.ServiceHours);

    var status = result.Status;
    var buttons = $(".modal-button").html();
    if (["3", "4"].includes(status)) {
      $(".modal-button").html("");
    }else{
      $(".modal-button").html(buttons);
    }
    var extraid = result.ServiceExtraId;
    extraid = extraid == null ? 0 : extraid;
    const extra = [
      "Inside cabinet",
      "Inside fridge",
      "Inside Oven",
      "Laundry wash & dry",
      "Interior windows",
    ];
    var extrahtml = "";
    if (extraid != 0) {
      extraid.split("").forEach((id) => {
        extrahtml += extra[+id - 1] + ", ";
      });
    }
    var totalbill = result.TotalCost;
    var serviceaddress =
      result.AddressLine1 + ", " + result.City + ", " + result.PostalCode;
    var haspets = result.HasPets;

    $(".m-time").text(
      date.startdate + " " + date.starttime + "-" + date.endtime
    );
    $(".total-duration").text(result.ServiceHours);
    $(".sid").text(("000" + result.ServiceRequestId).slice(-4));
    $(".extraslist").text(extrahtml);
    $(".m-currency").text(totalbill + "€");
    $(".saddress").text(serviceaddress);
    $(".smobile").text(result.Mobile);
    $(".semail").text(result.Email);
    $(".haspets").html(
      haspets == 0
        ? '<span class="fa fa-times-circle-o"></span> I dont`t have pets at home'
        : '<span class="fa fa-check" style="color:#0f7a2b"></span> I have pets at home'
    );
  });

  function getDefaultRecords() {
    showLoader();
    $.ajax({
      type: "POST",
      url:
        "http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=CDashboard&function=TotalRequest&parameter=" +
        req,
      datatype: "json",
      success: function (data) {
        //console.log(data);
        var obj = JSON.parse(data);
        var _records = obj.result.TotalRequest;
        $(".show-apge .totalrecords").text(_records);
        return _records;
      },
      complete: function (data) {
        $.LoadingOverlay("hide");
      },
    });
    return 0;
  }
  function getAjaxDataByReq() {
    showLoader();
    var req = $("#req").val();
    $.ajax({
      type: "POST",
      url:
        "http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=CDashboard&function=ServiceRequest&parameter=" +
        req,
      datatype: "json",
      data: { pagenumber: currentpage, limit: showrecords },
      success: function (data) {
        //console.log(data);
        obj = JSON.parse(data);
        $("table tbody").html("");
        if (obj.errors.length == 0) {
          records = obj.result;
          switch (req) {
            case "service-history":
                setDashboardTabRows(obj.result);
                break;
            case "favorite-pros":
                break;
            case "setting":
                break;
            case "dashboard":
                setDashboardTabRows(obj.result);
                break;
            default:
              setDashboardTabRows(obj.result);
          }
        }
      },
      complete: function (data) {
        $.LoadingOverlay("hide");
      },
    });
  }

  function getStarHTMLByRating(avgrating) {
    spstar = "";
    var i = 0;
    for (i = 0; i < Math.floor(avgrating); i++) {
      spstar += '<span class="fa fa-star"></span>';
    }
    if (Math.floor(avgrating) < avgrating) {
      i++;
      spstar += '<span class="fa fa-star-half-o"></span>';
    }
    if (i < 5) {
      for (var j = 0; j < 5 - i; j++) {
        spstar += '<span class="fa fa-star-o"></span>';
      }
    }
    return spstar;
  }

  function setDashboardTabRows(results) {
    var html = "";
    var i = 0;
    results.forEach((result) => {
      //console.log(result);
      var sphtml = "";
      var status = result.Status;
      var stshtml = "";
      if (["3", "4"].includes(status)) {
        stshtml =
          status == "4"
            ? '<td class="btn-status completed"><button>Completed</button></td>'
            : '<td class="btn-status cancelled"><button>Cancelled</button></td>';
        stshtml +=
          '<td class="btn-ratesp"><button data-bs-toggle="modal" data-bs-target="#exampleModalRateSP" data-bs-dismiss="modal">RateSP</button></td>';
      }
      if (result.ServiceProviderId != null) {
        var avatar =
          result.UserProfilePicture == null
            ? "avatar-hat.png"
            : result.UserProfilePicture;
        var avgrating = result.AverageRating;
        var spstar = getStarHTMLByRating(avgrating);
        sphtml = `
            <div class="rating-user"><img src="./static/images/avtar/${avatar}" alt="">
                            </div>
                            <div class="rating-info">
                                <div class="info-name">${result.Fullname}</div>
                                <div class="info-ratings">${spstar}
                                    (${result.TotalRating})
                                </div>
                            </div>
            `;
      }
      var date = getTimeAndDate(result.ServiceStartDate, result.ServiceHours);
      html += `
        <tr id='data_${i}'>
                    <td scope="row"  style="line-height: 50px;cursor:pointer;" data-bs-toggle="modal" data-bs-target="#exampleModalServiceDetailes" data-bs-dismiss="modal" class='serviceid show_detailes'>${(
                      "000" + result.ServiceRequestId
                    ).slice(-4)}</td>
                    <td style='cursor:pointer;' data-bs-toggle="modal" data-bs-target="#exampleModalServiceDetailes" data-bs-dismiss="modal" class='show_detailes'>
                        <div class="td-date"><img src="./static/images/icon-calculator.png" alt=""><b>${
                          date.startdate
                        }</b></div>
                        <div class="td-time"><img src="./static/images/icon-time.png" alt="">${
                          date.starttime
                        }-${date.endtime}</div>
                    </td>
                    <td>
                        <div class="td-rating">
                            ${sphtml}
                        </div>
                    </td>
                    <td style="line-height: 50px;">
                        <div class="td-currn">€<span>${
                          result.TotalCost
                        }</span></div>
                    </td>
                    `;
      if (stshtml == "") {
        html += `<td class="btn-dashboard">
              <button class="btn-reschedule" data-bs-toggle="modal" data-bs-target="#exampleModalServiceReschedule" data-bs-dismiss="modal">Reschedule</button>
              <button class="btn-cancel" data-bs-toggle="modal" data-bs-target="#exampleModalServiceCancel" data-bs-dismiss="modal">Cancel</button>
          </td>
      </tr>`;
      } else {
        html += stshtml + "</tr>";
      }

      i++;
    });
    $("table tbody").html(html);
  }

  // for updating page number
  function updatePageNumber(number) {
    if (totalpage < currentpage) {
      number = totalpage;
    }
    $(".paginations .current-page").text(number);
  }

  // get time and date in required format
  function getTimeAndDate(sdate, stime) {
    //alert(sdate, stime);
    var dateobj = new Date(sdate);
    var startdate = dateobj.toLocaleDateString("en-US");
    var starttime =
      ("0" + dateobj.getHours()).slice(-2) +
      ":" +
      ("0" + dateobj.getMinutes()).slice(-2);
    var totalhour = stime;

    var endhour = dateobj.getHours() + Math.floor(totalhour);
    var endmin =
      (totalhour - Math.floor(totalhour)) * 60 + dateobj.getMinutes();
    if (endmin >= 60) {
      endhour = endhour + Math.floor(endmin / 60);
      endmin = (endmin / 60 - Math.floor(endmin / 60)) * 60;
    }
    var endtime = ("0" + endhour).slice(-2) + ":" + ("0" + endmin).slice(-2);
    return { startdate: startdate, starttime: starttime, endtime: endtime };
  }
});
