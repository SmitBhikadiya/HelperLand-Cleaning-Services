<div class="div-content table-responsive">
    <div class="shistory-title">
        <p>Current Service Requests</p>
        <button>Add New Service Requests</button>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Service Id <img src="./static/images/icon-sort.png" alt="">
                    </th>
                    <th scope="col">Service Date <img src="./static/images/icon-sort.png" alt="">
                    </th>
                    <th scope="col">Service Provider <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Payment <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" style="line-height: 50px;cursor:pointer;" data-bs-toggle="modal" data-bs-target="#exampleModalServiceDetailes" data-bs-dismiss="modal">323436</td>
                    <td>
                        <div class="td-date"><img src="./static/images/icon-calculator.png" alt=""><b>09/04/2018</b></div>
                        <div class="td-time"><img src="./static/images/icon-time.png" alt="">12:00-18:00</div>
                    </td>
                    <td>
                        <div class="td-rating">
                            <div class="rating-user"><img src="./static/images/icon-cap.png" alt="">
                            </div>
                            <div class="rating-info">
                                <div class="info-name">Lyum Watson</div>
                                <div class="info-ratings">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star-o"></span>
                                    4
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="line-height: 50px;">
                        <div class="td-currn">€<span>65</span></div>
                    </td>
                    <td class="btn-dashboard">
                        <button data-bs-toggle="modal" class="btn-reschedule" data-bs-toggle="modal" data-bs-target="#exampleModalServiceReschedule" data-bs-dismiss="modal">Reschedule</button>
                        <button data-bs-toggle="modal" class="btn-cancel" data-bs-toggle="modal" data-bs-target="#exampleModalServiceCancel" data-bs-dismiss="modal">Cancel</button>
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
            entries Total Record : 7
        </div>
        <div class="paginations">
            <div class="jump-left"><img src="./static/images/jump-left.png" alt=""></div>
            <div class="next-left"><img src="./static/images/next-left.png" alt=""></div>
            <div class="current-page">1</div>
            <div class="next-right"><img src="./static/images/next-left.png" alt=""></div>
            <div class="jump-right"><img src="./static/images/jump-left.png" alt=""></div>
        </div>
    </div>
</div>