<!-- Model For Address Edit -->
<div class="modal fade" id="exampleModalEditAddress" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Edit Address</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 form-group">
                                <label for="">Street name</label>
                                <input type="text" class="form-control" name="streetname" value="Koigneestrasee">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Hourse number</label>
                                <input type="number" class="form-control" name="housenumber" value="112">
                            </div>
                        </div>
                    
                        <div class="col-6">
                            <div class="mb-3 form-group">
                                <label for="">Postal Code</label>
                                <input type="number" class="form-control" name="postalcode" value="99897">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" class="form-control" name="city" value="Tambaruh-Deizeth">
                            </div>
                        </div>
                    
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">+49</div>
                                    </div>
                                    <input type="number" name="mobile" class="form-control" id="inlineFormInputGroup" placeholder="Phone number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="submit-button mb-3" type="submit" name="editaddress">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Model -->