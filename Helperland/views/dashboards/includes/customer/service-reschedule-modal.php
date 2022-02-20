<!-- Model For Service Reschedule -->
<div class="modal fade" id="exampleModalServiceReschedule" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Reschedule Service Request</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3 form-group">
                            <label for="">Select New Date & Time</label>
                            <div class="row">
                                <div class="col">
                                <input type="date" class="form-control" name="date" value="2021-07-10">
                                </div>
                                <div class="col">
                                <select name="time" class="form-select" id="">
                                    <option value="8:00">8:00</option>
                                    <option value="9:00">9:00</option>
                                </select>
                                </div>
                            </div>
                        </div>

                        <button class="submit-button mb-3" type="submit" name="reschedule">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->