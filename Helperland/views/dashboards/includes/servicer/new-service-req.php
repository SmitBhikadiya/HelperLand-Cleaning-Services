<div class="div-content table-responsive">
    <div class="service-filter">
        Servicer Area <select class="form-select" aria-label="Default select example">
            <option value="2">2</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25" selected>25</option>
        </select>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheck" checked>
            <label class="form-check-label" for="flexCheck">
                include pat at home
            </label>
        </div>
    </div>
    <div id="upcomingservice">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Service ID <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Service date <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Cutomer details <img src="./static/images/icon-sort.png" alt="">
                    </th>
                    <th scope="col">Payment <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Time conflict <img src="./static/images/icon-sort.png" alt=""></th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" style="line-height: 50px;">323436</td>
                    <td>
                        <div class="td-date"><img src="./static/images/icon-calculator.png" alt=""><b>09/04/2018</b></div>
                        <div class="td-time"><img src="./static/images/icon-time.png" alt="">12:00 -
                            18:00</div>
                    </td>
                    <td>
                        <div class="td-name">David Bough</div>
                        <div class="td-address"><img src="./static/images/icon-address.png" alt="">Musterstrabe 5,12345 Bonn</div>
                    </td>
                    <td>56,25€</td>
                    <td></td>
                    <td class="btn-accept"><button data-bs-toggle="modal" data-bs-target="#exampleModalServiceAccept" data-bs-dismiss="modal">Accept</button></td>
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