    <div class="modal fade bd-viewReservation-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><center>Reservation Details</center></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Booking No:</b> <span id="CustomerId"></span> </P>  
                                </div>
                                <div class="col-md-4">
                                    <p><b>Arrival Date:</b> <span id="ArrivalDate"></span> </P>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Departure Date:</b> <span id="DepartureDate"></span> </P>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Billed to:</b> 
                                        <br><span id="CustomerName"></span>,
                                        <br><span id="CustomerCountry"></span>.
                                        <br><span id="CustomerEmail"></span>
                                        <br><span id="CustomerContact"></span>
                                    </p>  
                                </div>
                                <div class="col-md-4">
                                    <p><b>Customer Note:</b> 
                                        <br><span id="CustomerNote"></span> 
                                    </P>
                                </div>
                            </div>
                        </div>
                    </div>
  
                    <div class="row">
                        <div class="table-responsive">
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:70%">Description</th>
                                    <th style="width:15%">Qty</th>
                                    <th style="width:15%">Rate</th>
                                </tr>
                            </thead>
                            <tbody class="Bill">

                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>