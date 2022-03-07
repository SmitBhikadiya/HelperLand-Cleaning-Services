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
            <input class="form-check-input" type="checkbox" value="1" id="hasapets" checked>
            <label class="form-check-label" for="hasapets">
                include pat at home
            </label>
        </div>
    </div>
    <div id="upcomingservice">
        <table class="table" id="table-newrequest">
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
                
            </tbody>
        </table>
    </div>
    <div class="shistory-pagination">
        <div class="show-apge">
            show
            <select class="form-select" aria-label="Default select example">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="30">30</option>
            </select>
            entries Total Record : <span class="totalrecords"><span>
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