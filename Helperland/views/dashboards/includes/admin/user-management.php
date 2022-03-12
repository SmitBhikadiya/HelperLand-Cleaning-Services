<div class="div-content" id="usermanagement">
    <div class="shistory-title">
        <p>User Management</p>
        <button><span class="fa fa-plus-circle"></span>Add New User</button>
    </div>
    <div class="search-bar">
        <form action="#">
            <div class="search-row">
                <div class="search-col">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>User name</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="search-col">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>User Type</option>
                        <option value="1">Customer</option>
                        <option value="2">Servicer</option>
                        <option value="3">Admin</option>
                    </select>
                </div>
                <div class="search-col">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+49</span>
                        <input type="text" class="form-control" placeholder="Phone Number" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="search-col">
                    <input type="text" class="form-control" placeholder="Postal code">
                </div>
                <div class="search-col">
                    <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="search-col div-date">
                     <img src="static/images/admin-calendar.png" alt="">
                     <input type="text" class="form-control" placeholder="From Date" title="Format:-yyyy-mm-dd">
                 </div>
                 <div class="search-col div-date">
                    <img src="static/images/admin-calendar.png" alt="">
                    <input type="text" class="form-control" placeholder="To Date" title="Format:-yyyy-mm-dd">
                 </div>
                <div class="search-col col-buttons">
                    <button type="Search" class="btn-search">Search</button>
                    <button type="reset" class="btn-clear">Clear</button>
                </div>
            </div>
        </form>
    </div>
    <div id="servicehistory" class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User Name <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">User Type <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Date of Registration</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Postal Code <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Status <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="td-name">Lyum Watson</div>
                    </td>
                    <td>
                        <div class="td-name">Call Center</div>
                    </td>
                    <td>
                        <div class="td-name">Inquiry Manager</div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Service Provider</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name">10 Km</div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Call Center</div>
                    </td>
                    <td>
                        <div class="td-name">Inquiry Manager</div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Customer</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Call Center</div>
                    </td>
                    <td>
                        <div class="td-name">Content Manager</div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Customer</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td class="btn-status cancelled"><button>Inactive</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Service Provider</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name">20 Km</div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Call Center</div>
                    </td>
                    <td>
                        <div class="td-name">Finance Manager</div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Customer</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="td-name">John Smith</div>
                    </td>
                    <td>
                        <div class="td-name">Customer</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td>
                        <div class="td-name">123456</div>
                    </td>
                    <td>
                        <div class="td-name">Berlin</div>
                    </td>
                    <td>
                        <div class="td-name"></div>
                    </td>
                    <td class="btn-status completed"><button>Active</button></td>
                    <td class="btn-raction">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./static/images/icon-menudot.png" alt="">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Edit</button></li>
                                <li><button class="dropdown-item" type="button">Deactivate</button>
                                </li>
                                <li><button class="dropdown-item" type="button">Service
                                        History</button>
                                </li>
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
                 <option value=2>2</option>
                 <option value="5">5</option>
                 <option value="10" selected>10</option>
                 <option value="50">50</option>
             </select>
             Entries, Total Record : <span class="totalrecords"><span>
         </div>
         <div class="paginations">
             <div class="next-left changepage"><img src="./static/images/next-left.png" alt=""></div>
             <div class="next-right changepage"><img src="./static/images/next-left.png" alt=""></div>
         </div>
     </div>
    <div class="shistory-footer">
        ©2018 Helperland. All rights reserved.
    </div>
</div>