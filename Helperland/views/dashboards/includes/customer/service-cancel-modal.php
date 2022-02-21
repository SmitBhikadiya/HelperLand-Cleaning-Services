<!-- Model For Service Cancel -->
<div class="modal fade" id="exampleModalServiceCancel" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Cancel Service Request</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../Helperland/users.php" method="POST">
                    <input type='hidden' name='serviceid'>
                        <div class="mb-3 form-group icon-textbox">
                            <label for="">Why you want to cancel this service?</label>
                            <textarea class="form-control" name="whyyouwant" id="" rows="3"></textarea>
                        </div>

                        <button class="submit-button mb-3" type="submit" name="cancelservice">Cancel Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->