<div class="div-content" id="servicerequest">
     <div class="shistory-title">
         <p>Service Requests</p>
     </div>
     <div class="search-bar">
         <form action="#">
             <div class="search-row">
                 <div class="search-col">
                     <input type="number" class="form-control" placeholder="Service ID">
                 </div>
                 <div class="search-col">
                     <input type="number" class="form-control" placeholder="Postal Code">
                 </div>
                 <div class="search-col">
                     <input type="email" class="form-control" placeholder="Email">
                 </div>
                 <div class="search-col form-group">
                     <select class="form-select" aria-label="Default select example">
                         <option selected>Select Customer</option>
                         <option value="david bought">David Bough</option>
                     </select>
                 </div>
                 <div class="search-col form-group">
                     <select class="form-select" aria-label="Default select example">
                         <option selected>Service Service Provider</option>
                         <option value="lyum watson">Lyum Watson</option>
                     </select>
                 </div>
                 <div class="search-col form-group">
                     <select class="form-select" aria-label="Default select example">
                         <option selected>Select Status</option>
                         <option value="New">New</option>
                         <option value="Pending">Pending</option>
                         <option value="Completed">Completed</option>
                         <option value="Cancelled">Cancelled</option>
                     </select>
                 </div>
                 <div class="search-col form-group">
                     <select class="form-select" aria-label="Default select example">
                         <option selected>SP Payment Status</option>
                         <option value="lyum watson">Lyum Watson</option>
                     </select>
                 </div>
                 <div class="search-col">
                     <div class="form-check">
                         <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                         <label class="form-check-label" for="defaultCheck1">
                             Has issue
                         </label>
                     </div>
                 </div>
                 <div class="search-col">
                     <input type="date" class="form-control" placeholder="From Date">
                 </div>
                 <div class="search-col">
                     <input type="date" class="form-control" placeholder="To Date">
                 </div>
                 <div class="search-col col-buttons">
                     <button type="Search" class="btn-search">Search</button>
                     <button type="reset" class="btn-clear">Clear</button>
                 </div>
             </div>
         </form>
     </div>
     <div id="servicehistory" class="servicerequests table-responsive">
         <table class="table">
             <thead>
                 <tr>
                     <th scope="col">Service ID </th>
                     <th scope="col">Service Date 
                     </th>
                     <th scope="col">Customer detailes </th>
                     <th scope="col">Service Provider </th>
                     <th scope="col">Gross Amount </th>
                     <th scope="col">Net Amount </th>
                     <th scope="col">Discount </th>
                     <th scope="col">Status </th>
                     <th scope="col">Payment Status</th>
                     <th scope="col">Action</th>

                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>
                         <div class="td-name">8479</div>
                     </td>
                     <td>
                         <div class="td-date"><img src="./static/images/icon-calculator.png" alt=""><b>09/04/2018</b></div>
                         <div class="td-time"><img src="./static/images/icon-time.png" alt="">12:00 -
                             18:00</div>
                     </td>
                     <td>
                         <div class="td-name">David Bough</div>
                         <div class="td-address"><img src="./static/images/icon-address.png" alt="">Musterstrabe 5,12345 Bonn</div>
                     </td>
                     <td>
                         <div class="td-name"></div>
                     </td>
                     <td>
                         <div>75.00€</div>
                     </td>
                     <td>
                         <div>75.00€</div>
                     </td>
                     <td>
                         <div></div>
                     </td>
                     <td class="service-status new"><p>New</p></td>
                     <td class="service-status na"><p>Not Applicable</p></td>
                     <td class="btn-raction">
                         <div class="dropdown">
                             <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                 <img src="./static/images/icon-menudot.png" alt="">
                             </button>
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                 <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-bs-dismiss="modal">Edit &
                                         Reschedule</button></li>
                                 <li><button class="dropdown-item" type="button">Cancel SR by Cust</button>
                                 <li><button class="dropdown-item" type="button">Inquiry</button>
                                 <li><button class="dropdown-item" type="button">History Log</button>
                                 <li><button class="dropdown-item" type="button">Download Invoice</button></li>
                                <li><button class="dropdown-item" type="button">Other Transaction</button>
                             </ul>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         <div class="td-name">8479</div>
                     </td>
                     <td>
                         <div class="td-date"><img src="./static/images/icon-calculator.png" alt=""><b>09/04/2018</b></div>
                         <div class="td-time"><img src="./static/images/icon-time.png" alt="">12:00 -
                             18:00</div>
                     </td>
                     <td>
                         <div class="td-name">David Bough</div>
                         <div class="td-address"><img src="./static/images/icon-address.png" alt="">Musterstrabe 5,12345 Bonn</div>
                     </td>
                     <td>
                         <div class="td-name"></div>
                     </td>
                     <td>
                         <div>75.00€</div>
                     </td>
                     <td>
                         <div>75.00€</div>
                     </td>
                     <td>
                         <div></div>
                     </td>
                     <td class="service-status completed"><p>Completed</p></td>
                     <td class="service-status setled"><p>Setled</p></td>
                     <td class="btn-raction">
                         <div class="dropdown">
                             <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                 <img src="./static/images/icon-menudot.png" alt="">
                             </button>
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                 <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalRedund" data-bs-dismiss="modal">Refund</button></li>
                                 <li><button class="dropdown-item" type="button">Inquiry</button>
                                 <li><button class="dropdown-item" type="button">History Log</button>
                                 <li><button class="dropdown-item" type="button">Download Invoice</button></li>
                                 <li><button class="dropdown-item" type="button">Has Issue</button></li>
                                <li><button class="dropdown-item" type="button">Other Transaction</button>
                             </ul>
                         </div>
                     </td>
                 </tr>
             </tbody>
         </table>
     </div>
     <div class="shistory-pagination">
         <div class="show-apge">
             show
             <select class="form-select" aria-label="Default select example">
                 <option selected>10</option>
                 <option value="20">20</option>
                 <option value="50">50</option>
                 <option value="100">100</option>
             </select>
             Entries
         </div>
         <div class="paginations">
             <div class="next-left"><img src="./static/images/next-left.png" alt=""></div>
             <div class="current-page">1</div>
             <div>2</div>
             <div>3</div>
             <div>4</div>
             <div>5</div>
             <div class="next-right"><img src="./static/images/next-left.png" alt=""></div>
         </div>
     </div>
     <div class="shistory-footer">
         ©2018 Helperland. All rights reserved.
     </div>
 </div>