<div class="div-content table-responsive">
    <div class="shistory-title">
        <p>Current Service Requests</p>
        <button onclick="window.location='<?=$base_url.'?controller=Default&function=booknow'?>'">Add New Service Requests</button>
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
            entries Total Record : <span class="totalrecords">50<span>
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