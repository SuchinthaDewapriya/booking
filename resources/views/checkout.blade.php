@extends('layouts.app')

@section('content')

<header id="gtco-header" class="gtco-cover-custom gtco-cover-md" role="banner" style="background:url(public/images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="row row-mt-15em">
                    <center><h1 class="cursive-font">Checkout</h1></center>
                </div>                
            </div>
        </div>
    </div>
</header>
<div class="gtco-section">
    <div class="gtco-container checkout">
        <div class="row"> 
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="animate-box" data-animate-effect="fadeInRight">
                    <div class="card reservation-card">
                        <div class="card-body">
                            <div class="card reservation-card1">
                                <div class="card-body">
                                        <center><h3 class="font">Room Details</h3></center><hr><br>
                                    <table class="table table-light">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Rate (Rs.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img width="30px" src="{{ asset('public/images/rooms')}}/{{$image}}" alt="">
                                                </td>
                                                <td>
                                                    {{$r_name}} for {{$days}} @if($days == 1) Day @else Days @endif
                                                </td>
                                                <td>
                                                    {{$quantity}} 
                                                </td>
                                                <td>
                                                    Rs.{{$FinalTotal}} <br>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="animate-box" data-animate-effect="fadeInRight">
                        <div class="card reservation-card">
                            <div class="card-body">
                                <div class="card reservation-card1">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <div class="d-flex justify-content-center">
                                                <center><h3 class="font">Your Details</h3></center><hr><br>
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
                                                    <input type="hidden" name="quantity" value="{{$quantity}}">
                                                    @if ($bed != '')
                                                    @foreach ($bed as $item)
                                                    <input type="hidden" name="bed[]" value="{{$item}}">
                                                @endforeach
                                                    @endif
                                                    
                                                    {{-- <input type="hidden" name="bed[]" value="{{$bed}}"> --}}
                                                    @foreach ($setting as $item)
                                                        <input type="hidden" name="OwnerMail" value="{{$item->s_mail}}">
                                                    @endforeach
                                                    
                                                    <input type="hidden" name="package" value="{{$package}}">
                                                    <input type="hidden" name="ratebed" value="{{$ratebed}}">
                                                    <input type="hidden" name="fixedrate" value="{{$fixedrate}}">
                                                    <input type="hidden" name="id" value="{{$id}}">
                                                    <input type="hidden" name="r_name" value="{{$r_name}}">
                                                    <input type="hidden" name="additionalPackage" value="{{$additionalPackage}}">
                                                    <input type="hidden" name="TotalRoomRate" value="{{$TotalRoomRate}}">
                                                    <input type="hidden" name="TotalBedRate" value="{{$TotalBedRate}}">
                                                    <input type="hidden" name="TotalPackageRate" value="{{$TotalPackageRate}}">
                                                    <input type="hidden" name="TotalPackageRate" value="{{$TotalPackageRate}}">
                                                    <input type="hidden" name="FinalTotal" value="{{$FinalTotal}}">
                                                    <input type="hidden" name="packagerate" value="{{$packagerate}}">
                                                    <input type="hidden" name="days" value="{{$days}}">
                                                    <input type="hidden" name="checkIn" value="{{$checkIn}}">
                                                    <input type="hidden" name="checkOut" value="{{$checkOut}}">
                                                    <div style="padding:15px;">
                                                        <button type="button" onclick="BookNow()" class="btn btn-primary">Reserve Now <img width="20px" src='{{ asset('public/images/reserveLoader.gif') }}' id="bookingLoader" style='display: none;'></button>
                                                    </div>    
                                                </form>
                                                <div id="salutationError"></div>
                                                <div id="fnameError"></div>
                                                <div id="lnameError"></div>
                                                <div id="countryError"></div>
                                                <div id="mobileError"></div>
                                                <div id="emailError"></div>
                                                <div id="checkmeError"></div>
                                            </div>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>      

<script>

    function BookNow() {
        let BookNow = $('#BookingForm').serialize()
        $.ajax({
            type: "POST",
            url: "{{ url('storeData')}}",
            data: BookNow,
            beforeSend: function(){
            // Show image container
            $("#bookingLoader").show();
            },
            success: function (response) {
                if (response.errors) {
                    $('#salutationError').empty()
                    $('#fnameError').empty()
                    $('#lnameError').empty()
                    $('#countryError').empty()
                    $('#mobileError').empty()
                    $('#emailError').empty()
                    $('#checkmeError').empty()

                    if (response.errors[0] != null) {
                        $('#salutationError').append('<div class="alert alert-danger">'+response.errors[0]+'</div>')
                    }
                    if (response.errors[1] != null) {
                        $('#fnameError').append('<div class="alert alert-danger">'+response.errors[1]+'</div>')
                    }
                    if (response.errors[2] != null) {
                        $('#lnameError').append('<div class="alert alert-danger">'+response.errors[2]+'</div>')
                    }
                    if (response.errors[3] != null) {
                        $('#countryError').append('<div class="alert alert-danger">'+response.errors[3]+'</div>')
                    }
                    if (response.errors[4] != null) {
                        $('#mobileError').append('<div class="alert alert-danger">'+response.errors[4]+'</div>')
                    }
                    if (response.errors[5] != null) {
                        $('#emailError').append('<div class="alert alert-danger">'+response.errors[5]+'</div>')
                    }
                    if (response.errors[6] != null) {
                        $('#checkmeError').append('<div class="alert alert-danger">'+response.errors[6]+'</div>')
                    }
                } else {
                    $('#salutationError').empty()
                    $('#fnameError').empty()
                    $('#lnameError').empty()
                    $('#countryError').empty()
                    $('#mobileError').empty()
                    $('#emailError').empty()
                    $('#checkmeError').empty()
                    $('.checkoutError').empty()

                    swal('Reserved!','Your room reserved.','success')
                    $('.checkout').empty()
                    $('.checkout').append('<div class="row"><div class="col-md-1"></div><div class="col-md-10"><div><div class="card reservation-card reservation-card-success"><div class="card-body"><div class="card reservation-card"><div class="card-body"><center><h1>Successfully reservation!</h1><span>Your reservation is under review')
                }
            },
            complete:function(data){
            // Hide image container
            $("#bookingLoader").hide();
            }
        });
    }

</script>
@endsection