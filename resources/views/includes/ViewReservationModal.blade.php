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
                    <form action="{{ url('print')}}" method="post">
                        @csrf
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
                                        <textarea name="" class="form-control" style="width:100%; height:auto;" id="CustomerNote" value="" disabled>
                                            Empty
                                        </textarea>
                                        <br>
                                    </P>
                                </div>
                                <div class="col-md-4">
                                    <select name="paymentMethod" class="form-control" id="">
                                        <option value="">Select payment method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Credit Card">Credit Card</option>
                                    </select><br>
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
                    {{-- Hiiden values --}}
                    <input type="hidden" name="BillName" class="inputClear" id="BillName">
                    <input type="hidden" name="BillBookingId" class="inputClear"  id="BillBookingId">
                    <input type="hidden" name="BillArrivalDate" class="inputClear"  id="BillArrivalDate">
                    <input type="hidden" name="BillDepartureDate" class="inputClear"  id="BillDepartureDate">
                    <input type="hidden" name="BillCustomerEmail" class="inputClear"  id="BillCustomerEmail">
                    <input type="hidden" name="BillCustomerContact" class="inputClear"  id="BillCustomerContact">
                    <input type="hidden" name="BillCustomerCountry" class="inputClear"  id="BillCustomerCountry">
                    <input type="hidden" name="BillCustomerNote" class="inputClear"  id="BillCustomerNote">
                    <input type="hidden" name="BillRoomName" class="inputClear"  id="BillRoomName">
                    <input type="hidden" name="BillRoomQty" class="inputClear"  id="BillRoomQty">
                    <input type="hidden" name="BillRoomRate" class="inputClear"  id="BillRoomRate">
                    <input type="hidden" name="BillPackageName" class="inputClear"  id="BillPackageName">
                    <input type="hidden" name="BillPackageRate" class="inputClear"  id="BillPackageRate">
                    <input type="hidden" name="BillBedQty" class="inputClear" id="BillBedQty">
                    <input type="hidden" name="BillBedRate" class="inputClear" id="BillBedRate">
                    <input type="hidden" name="OrdersProName[]" class="inputClear" id="OrdersProName">
                    <input type="hidden" name="OrdersProQty[]" class="inputClear" id="OrdersProQty">
                    <input type="hidden" name="OrdersProPrice[]" class="inputClear" id="OrdersProPrice">
                    <input type="hidden" name="OrdersGrandTotal" class="inputClear" id="OrdersGrandTotal">

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <center>
                            <button type="submit" formtarget="_blank" class="btn btn-warning">Create bill</button>
                            </center>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-orders-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add new orders</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="OrdersRoomForm">
                        @csrf
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="proName" id="OrderproName" class="form-control inputclear" placeholder="Product name">
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="proQty" id="OrderproQty" class="form-control inputclear" placeholder="Numbers only">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="proPrice" id="OrderproPrice" class="form-control inputclear" placeholder="Numbers only">
                        </div>
                        <input type="hidden" name="OrderBookingId" id="OrderBookingId" class="form-control inputclear" >
                        <button type="button" name="save" onclick="AddNewOrder()" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-NewBooking-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">New Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="BookingForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="Salutation">Salutation</label>
                                <select name="salutation" id="Salutation" class="form-control">
                                    <option value="Mr">Mr</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" name="FirstName" id="fname" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-5">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" name="LastName" id="lname" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            @php
                                $country = DB::table('apps_countries')->get();
                            @endphp
                            <label for="country">Country</label>
                            <select name="country" class="form-control" id="country">
                                <option value="Sri Lanka">Select country</option>
                                @foreach ($country as $item)
                                    <option value="{{$item->country_name}}">{{$item->country_name}}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="mobile">Mobile</label>
                            <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Contact number">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="note">Note</label>
                            <textarea id="note" class="form-control" name="note" rows="3" placeholder="Note"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Privacy" id="gridCheck" value="true">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>
                            </div>
                        </div>
                        <div style="padding:15px;">
                            <button type="button" onclick="BookNow()" class="btn btn-primary">Reserve Now <img width="20px" src='{{ asset('public/images/reserveLoader.gif') }}' id="bookingLoader" style='display: none;'></button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
    