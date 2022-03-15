function showLoader() {
    $.LoadingOverlay("show", {
      background: "rgba(0, 0, 0, 0.7)",
    });
}
$(document).ready(function () {
      
        // Declare some global variable
        var today = new Date();
        var today_ =today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ("0" + today.getDate()).slice(-2);
        var req = $("#req").val();
        var tommorrow = new Date();
        tommorrow.setDate(tommorrow.getDate() + 1);
        tommorrow =tommorrow.getFullYear() + "-" + ("0" + (tommorrow.getMonth() + 1)).slice(-2) + "-" + ("0" + tommorrow.getDate()).slice(-2);
        var currentpage = 1; // current page number
        var showrecords = $(".show-apge select").val(); // total records shown in select input
        var totalpage = 1;
        var records = [];
        var totalrecords = 0;
        var searchdata = "";

        getDefaultRecords();
        setTimeout(setDefault, 100);
      
      $(document).on("click", ".paginations .changepage", function () {
        var actionclass = $(this).prop("class").split(" ")[0];
        //alert(currentpage);
        switch (actionclass) {
          case "next-left":
            if (currentpage > 1) {
              currentpage--;
              $(".paginations div").removeClass("current-page");
              if(currentpage<5){
                  $(".paginations div.pagenumber:nth-child("+(currentpage+1)+")").addClass("current-page");
              }else{
                  $(".paginations div.pagenumber:nth-child("+(6)+")").text(currentpage);
                  $(".paginations div.pagenumber:nth-child("+(6)+")").addClass("current-page");
              }
            }
            break;
          case "next-right":
            if (currentpage < totalpage) {
              currentpage++;
              $(".paginations div").removeClass("current-page");
              if(currentpage<5){
                  $(".paginations div.pagenumber:nth-child("+(currentpage+1)+")").addClass("current-page");
              }else{
                  $(".paginations div.pagenumber:nth-child("+(6)+")").text(currentpage);
                  $(".paginations div.pagenumber:nth-child("+(6)+")").addClass("current-page");
              }
            }
            break;
        }
        updatePageNumber(currentpage);
        getAjaxDataByReq();
      });
      $(document).on("click", ".pagenumber", function(){
          currentpage = +$(this).text();
          $(".pagenumber").removeClass("current-page");
          $(this).addClass("current-page");
          updatePageNumber(currentpage);
          getAjaxDataByReq();
      });
      $(document).on("change", ".show-apge select", function () {
        showrecords = $(this).val();
        totalpage = Math.ceil(totalrecords / showrecords);
        totalpage = totalpage == 0 ? 1 : totalpage;
        currentpage = 1;
        updatePageNumber(currentpage);
        setDefault();
      });
      $(document).on("click", ".btn-isapproved", function(){
        var userid = $(this).data("id");
        var admin = $("#aid").val();
        $.ajax({
          type: "POST",
          url: "http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=ADashboard&function=SetApprovedByAdmin",
          datatype: "json",
          data: {userid:userid, aid:admin},
          success: function (data) {
            console.log(data);
            obj = JSON.parse(data);
            if (obj.errors.length == 0) {
              getDefaultRecords();
              setTimeout(setDefault, 100);
            }
          }
        });
      });      
      $(document).on("click",".div-sidebar .nav-tog p", function () {
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
      $(document).on("click", ".div-sidebar a", function () {
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
      $(document).on("click", ".btn-service-search", function(e){
        e.preventDefault();
        currentpage = 1;
        var servid = $("#serviceid").val();
        var postal = $("#postalcode").val();
        var email = $("#email").val();
        var customername = $("#customername").val();
        var servicername = $("#servicername").val();
        var servicestatus = $("#servicestatus").val();
        var hasissue = ($("#hasissue").is(":checked")) ? "1" : "";
        var fromdate = $("#fromdate").val();
        var todate = $("#todate").val();
        searchdata = "&serviceid="+servid+"&postal="+postal+"&email="+email+"&custid="+customername+"&servid="+servicername+"&status="+servicestatus+"&hasissue="+hasissue+"&fromdate="+fromdate+"&todate="+todate;
        getDefaultRecords();
        setTimeout(setDefault, 100);
      });
      $(document).on("click", ".btn-user-search", function(e){
        e.preventDefault();
        currentpage = 1;
        var username = $("#username").val();
        var usertype = $("#usertype").val();
        var mobile = $("#mobile").val();
        var postal = $("#postal").val();
        var email = $("#email").val();
        var fromdate = $("#fromdate").val();
        var todate = $("#todate").val();
        searchdata = "&username="+username+"&usertype="+usertype+"&mobile="+mobile+"&postal="+postal+"&email="+email+"&fromdate="+fromdate+"&todate="+todate;
        getDefaultRecords();
        setTimeout(setDefault, 100);
      });
      $(document).on("click", ".btn-clear", function(e){
        e.preventDefault();
        currentpage = 1;
        $("#form_searchreq").trigger("reset");
        searchdata = "";
        getDefaultRecords();
        setTimeout(setDefault, 100); 
      });
      $(document).on("click", '#export', function(){
        let data = document.getElementById('table');
        var fp = XLSX.utils.table_to_book(data,{sheet:'History'});
        XLSX.write(fp,{
          bookType:'xlsx',
          type:'base64'
        });
        XLSX.writeFile(fp, 'service-history.xlsx');
      });
      $(document).on("click", ".editreschedule", function(){
        var index = $(this).parent().data("index");
        var result = records[index];
        var date  = getTimeAndDate(result.ServiceStartDate, result.ServiceHours);
        $("#er-servid").val(result.ServiceRequestId);
        $("#er-date").val(date.startdate);
        $(".selecttime select option:contains("+date.starttime+")").attr('selected', 'selected');
        $("#er-street").val(result.AddressLine2);
        $("#er-house").val(result.AddressLine1);
        $("#er-postalcode").val(result.PostalCode);
        $("#er-mobile").val(result.Mobile);
        $("#er-city").html("<option value="+result.City.toLowerCase()+">"+result.City+"</option>");
        $("#er-comment").val(result.Comments);
      });
      $(document).on("click", ".refund", function(){
        var index = $(this).parent().data("index");
        var result = records[index];
      });
      $(document).on("keyup", "#er-postalcode", function (e) {
        var postal = $(this).val();
        if(postal.length == 5){
          $(".error").remove();
          showLoader();
          jQuery.ajax({
            type: "POST",
            url: "http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=Users&function=getCityByPostal",
            datatype: "json",
            data: {postalcode:postal},
            success: function (data) {
              var obj = JSON.parse(data);
              if(obj.errors.length==0){
                var option = "<option value="+obj.result.CityName.toLowerCase()+" selected>"+obj.result.CityName+"</option>";
                $("#er-city").html(option);
                //alert(obj.result.CityName);
              }else{
                $("#er-city").html("");
                $("#er-postalcode").after("<span class='error' style='color:red;'>*invalid postal code</span>");
              }
            },
            complete: function (data) {
              $.LoadingOverlay("hide");
            },
          });
        }else{
          $("#er-city").html("");
        }
      });
      $(document).on("click", "#btn-editandreschedule", function(e){
        e.preventDefault();
        showLoader();
        $(".alert").remove();
        var action = $(this).parent().parent().parent().prop("action");
        var adid = $("#aid").val();
        //alert(action+" "+adid);
        if($(this).parent().parent().parent().find('.error').length==0){
          jQuery.ajax({
            type: "POST",
            url: action,
            datatype: "json",
            data: $("#form-reschedule").serialize()+"&adid="+adid,
            success: function (data) {
              console.log(data);
              var obj = JSON.parse(data);
              if (obj.errors.length == 0) {
                $("#form-reschedule").prepend(
                  '<div class="alert alert-success alert-dismissible fade show" role="alert"><ul class="success">Service rescheduled Successfully!!</ul></div>'
                );
                getAjaxDataByReq();
              } else {
                var errorlist = "";
                for (const [key, val] of Object.entries(obj.errors)) {
                  errorlist += `<li>${val}</li>`;
                }
                $("#form-reschedule").prepend(
                  '<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="errorlist">' +
                    errorlist +
                    "</ul></div>"
                );
              }
              $([document.documentElement, document.body]).animate({
                scrollTop: $("#exampleModaledit").offset().top,
              },100);
            },
            complete: function (data) {
              $.LoadingOverlay("hide");
            },
          });
        }else{
          $.LoadingOverlay("hide");
        }
      });
      
      function setDefault() {
          totalrecords = $(".show-apge .totalrecords").text();
          totalpage = Math.ceil(totalrecords / showrecords);
          totalpage = totalpage == 0 ? 1 : totalpage;
          var pageshtml = '';
          $(".paginations .pagenumber").remove();
          for(var i=1;i<=totalpage && i<=4;i++){
              if(i==currentpage){
                pageshtml+="<div class='pagenumber current-page'>"+i+"</div>";
              }else{
                pageshtml+="<div class='pagenumber'>"+i+"</div>";
              }
          }
          if(totalpage>4){
            pageshtml+="<div class='pagenumber last_page'>"+5+"</div>";
          }
          $(".next-left").after(pageshtml);
          getAjaxDataByReq();
      }
      function getDefaultRecords() {
          $.ajax({
            type: "POST",
            url:"http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=ADashboard&function=TotalRequest&parameter="+req,
            datatype: "json",
            data: searchdata,
            success: function (data) {
              console.log(data);
              var obj = JSON.parse(data);
              var totalrequest = obj.result.Total;
              $(".show-apge .totalrecords").text(totalrequest);
              showrecords = $(".show-apge select").val();
            },
          });
      }
      function getAjaxDataByReq() {
          showLoader();
          var data = "pagenumber="+currentpage+"&limit="+showrecords+searchdata;
          $.ajax({
            type: "POST",
            url: "http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/?controller=ADashboard&function=ServiceRequest&parameter=" + req,
            datatype: "json",
            data: data,//{ pagenumber: currentpage, limit: showrecords, haspets:haspets, payment:payment, rating:rating, date:today_, postal:postal},
            success: function (data) {
              console.log(data);
              //alert(data);
              obj = JSON.parse(data);
              $("table tbody").html("");
              if (obj.errors.length == 0) {
                records = obj.result;
                console.log(records);
                switch (req) {
                  case "usermanagement":
                    setUserManagement(obj.result);
                    setUserManagementSearchBar(obj.alluser);
                    break;
                  default:
                    setServiceRequest(obj.result);
                    setServiceRequestSearchBar(obj.Customer,obj.Servicer);
                }
              }
            },
            complete: function (data) {
              $.LoadingOverlay("hide");
            },
          });
      }
      function updatePageNumber(number) {
          if (totalpage < currentpage) {
            number = totalpage;
          }
      }
      function getStatusName(st){
            var status;
            switch(+st){
                case 0:
                    status="new";
                    break;
                case 1:
                case 2:
                    status="pending";
                    break;
                case 3:
                    status="cancelled";
                    break;
                case 4:
                    status="completed";
                    break;
                case 5:
                  status="refunded";
                  break;
            }
            return status;
      }
      function setServiceRequest(results){
            var html = "";
            var i=0;
            results.forEach(result => {
                var date = getTimeAndDate(result.ServiceStartDate, result.ServiceHours);
                var sphtml = '';
                if (result.ServiceProviderId != null) {
                    var avatar =
                      result.UserProfilePicture == null
                        ? "avatar-hat.png"
                        : result.UserProfilePicture+".png";
                    var avgrating = result.AverageRating;
                    var spstar = getStarHTMLByRating(avgrating);
                    var avgrating = (+result.AverageRating).toFixed(2);
                    sphtml = `
                        <div class="rating-user"><img src="./static/images/avtar/${avatar}" alt="">
                                        </div>
                                        <div class="rating-info">
                                            <div class="info-name">${result.ServName}</div>
                                            <div class="info-ratings">${spstar}
                                                (${avgrating})
                                            </div>
                                        </div>
                        `;
                }
                var status = getStatusName(result.Status);
                var paymentstatus_cls = (+result.Status==4) ? "settled" : "na";
                var paymentstatus_name = (paymentstatus_cls=='na') ? "Not Aplicable" : "Settled";
                var action = (+result.Status==4 || +result.Status==3) ? `<li data-index=${i}><button class="dropdown-item refund" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalRedund" data-bs-dismiss="modal">Refund</button></li><li><button class="dropdown-item" type="button">Inquiry</button><li><button class="dropdown-item" type="button">History Log</button><li><button class="dropdown-item" type="button">Download Invoice</button></li><li><button class="dropdown-item" type="button">Has Issue</button></li><li><button class="dropdown-item" type="button">Other Transaction</button>` : `<li data-index=${i}><button class="dropdown-item editreschedule" type="button" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-bs-dismiss="modal">Edit &Reschedule</button></li><li><button class="dropdown-item" type="button">Cancel SR by Cust</button><li><button class="dropdown-item" type="button">Inquiry</button><li><button class="dropdown-item" type="button">History Log</button><li><button class="dropdown-item" type="button">Download Invoice</button></li><li><button class="dropdown-item" type="button">Other Transaction</button>`;
                html += `
                <tr id='data_${i}'>
                <td>
                    <div class="td-name">${("000" + result.ServiceRequestId).slice(-4)}</div>
                </td>
                <td>
                    <div class="td-date"><img src="./static/images/icon-calculator.png" alt=""><b>${date.startdate}</b></div>
                    <div class="td-time"><img src="./static/images/icon-time.png" alt="">${date.starttime}-${date.endtime}</div>
                </td>
                <td>
                    <div class="td-name">${result.CustName}</div>
                    <div class="td-address"><img src="./static/images/icon-address.png" alt="">${result.AddressLine1} ${result.AddressLine2},${result.PostalCode} ${result.City}</div>
                </td>
                <td>
                    <div class="td-rating rating_${i}">
                        ${sphtml}
                    </div>
                </td>
                <td>
                    <div>${result.TotalCost}€</div>
                </td>
                <td class="service-status ${status}"><p>${status}</p></td>
                <td class="service-status ${paymentstatus_cls}"><p>${paymentstatus_name}</p></td>
                <td class="btn-raction">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./static/images/icon-menudot.png" alt="">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                           ${action} 
                        </ul>
                    </div>
                </td>
            </tr>
                `;
                i++;
            });
            $("table tbody").html(html);

      }
      function setServiceRequestSearchBar(cust, serv){
          $("#customername").html("<option value='' selected>Select Customer</option>");
          $("#servicername").html("<option value='' selected>Select Servicer</option>");
          var cust_html = $("#customername").html();
          var serv_html = $("#servicername").html();
          cust.forEach(customer=>{
            //console.log(customer);
            cust_html+=`
            <option value=${customer.UserId}>${customer.UserName}</option>
            `;
          });
          serv.forEach(servicer=>{
            serv_html+=`
            <option value=${servicer.UserId}>${servicer.UserName}</option>
            `;
          });
          $("#customername").html(cust_html);
          $("#servicername").html(serv_html);
      }
      function setUserManagement(results){
            var html = "";
            var i=0;
            results.forEach(result => {
                var usertype = result.UserTypeId;
                var postal = (result.PostalCode==null) ? "" : result.PostalCode;
                var status = (result.IsApproved==0 || result.IsApproved==null) ? "InActive" : "Active";
                if(usertype==1){usertype="Customer";}
                else if(usertype==2){usertype="Servicer";}
                else if(usertype==3){usertype="Admin";}
                var IsApproved = (result.IsApproved==1) ? "DeActivate" : "Activate";
                html+=`
                <tr>
                    <td>
                        <div class="td-name">${result.UserName}</div>
                    </td>
                    <td>
                        <div class="td-name">${usertype}</div>
                    </td>
                    <td>
                        <div class="td-name"><img src="./static/images/icon-calculator.png" alt=""><b>${result.RegistrationDate}</b></div>
                    </td>
                    <td>
                        <div class="td-name">${result.Mobile}</div>
                    </td>
                    <td>
                        <div class="td-name">${postal}</div>
                    </td>
                    <td class="btn-status ${status}"><button>${status}</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item btn-isapproved ${IsApproved}" type="button" data-id=${result.UserId}>${IsApproved}</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                `;
            });
            $("table tbody").html(html);
      }
      function setUserManagementSearchBar(users){
          $("#username").html("<option value='' selected>User name</option>");
          var user_html = $("#username").html();
          users.forEach(user=>{
            //console.log(customer);
            user_html+=`
            <option value=${user.UserId}>${user.UserName}</option>
            `;
          });
          $("#username").html(user_html);
      }
      function getTimeAndDate(sdate, stime) {
          //alert(sdate, stime);
          var dateobj = new Date(sdate);
          var startdate = dateobj.toLocaleDateString("en-AU");
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
}); 