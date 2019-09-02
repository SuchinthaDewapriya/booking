@extends('layouts.app')

@section('content')
<header id="gtco-header" class="gtco-cover-custom gtco-cover-md" role="banner" style="background:url(public/images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="row row-mt-15em">
                    <center><h1 class="cursive-font">Room Reservation</h1></center>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="gtco-section">
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-wrap">
                            <div class="tab">
                                <div class="tab-content">
                                    <div class="tab-content-inner active" data-content="signup">
                                        <h3 class="cursive-font">Check Availability</h3>
                                        <form id="checkForm">
                                            @csrf
                                            {{-- <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="activities">Persons</label>
                                                    <select name="#" id="" class="form-control">
                                                        <option value="">1</option>
                                                        <option value="">2</option>
                                                        <option value="">3</option>
                                                        <option value="">4</option>
                                                        <option value="">5+</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="date-start">Arrival*</label>
                                                    <input type="date" name="checkIn" id="checkIn" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="date-start">Departure*</label>
                                                    <input type="date" name="checkOut" id="checkOut"  class="form-control" required>
                                                    
                                                </div>
                                            </div>
                                            {{-- <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="activities">Country</label>
                                                        <select name="#" id="" class="form-control">
                                                            <option value="">1</option>
                                                            <option value="">2</option>
                                                            <option value="">3</option>
                                                            <option value="">4</option>
                                                            <option value="">5+</option>
                                                        </select>
                                                    </div>
                                                </div> --}}
                                                <br>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <input type="button" onClick="Check()" class="btn btn-primary btn-block" value="Check">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        {{-- <div class="cart">
                            <h3 class="cursive-font">Your Rooms</h3>
                            <div id="cart-content">
                                @php
                                   $Total = 0;
                                @endphp
                                @if (count($data) > 0)
                                @foreach ($data as $cartContent)
                                <div class="row">
                                    <div class="col-md-2 col-sm-6">
                                        <img src="{{ asset('public/images/rooms')}}/{{$cartContent['attributes']->image}}" width="100%" alt="">
                                    </div>
                                    <div class="col-md-10 col-sm-6">
                                        {{$cartContent['quantity']}}
                                        @if ($cartContent['quantity'] > 1)
                                            {{$cartContent['name']}}s
                                        @else
                                            {{$cartContent['name']}}
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6">
                                         Rs.{{$cartContent['price']}} x {{$cartContent['attributes']->days}} days
                                    </div>
                                    <div class="col-md-4">
                                        @php
                                           $subtotal = $cartContent['price'] * $cartContent['attributes']->days;
                                        @endphp
                                        Rs.{{$subtotal}}

                                        @php
                                            $Total = $Total + $subtotal;
                                        @endphp
                                    </div>
                                </div><br>
                                @endforeach
                                <div class="total">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            Total
                                        </div>
                                        <div class="col-md-4">
                                            Rs.{{$Total}}
                                        </div>
                                    </div>
                                </div>
                                @else

                                @endif

                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <center>
                    <div id='searchLoader' style='display: none;'>
                        <img src='{{ asset('public/images/dataloader.gif') }}'>
                    </div>
                </center>
                <div class="rooms">
                    <div class="alert alert-warning">Please select arrival date and departure date</div>
                </div>
                <div id="checkInError"></div>
                <div id="checkOutError"></div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
var packageRate = {
  'price': 0,
  'bedRate': 0
}
var additionalBeds = {}
var roomRates = 0
var roomQty = 0
var totalBedRate = 0
var totalPackageRate = 0

function Check() {
    var checkForm = $("#checkForm").serialize();
    $.ajax({
        type: "POST",
        url: "{{ url('checkAvailability') }}",
        data: checkForm,
        beforeSend: function(){
            // Show image container
            $('.rooms').empty();
            $("#searchLoader").show();
        },
        success: function (response) {
            if (response.errors) {
                $('#checkInError').empty()
                $('#checkOutError').empty()

                if (response.errors[0] != null) {
                    $('#checkInError').append('<div class="alert alert-danger">'+response.errors[0]+'</div>')
                }
                if (response.errors[1] != null) {
                    $('#checkOutError').append('<div class="alert alert-danger">'+response.errors[1]+'</div>')
                }
            }
            else{
                $('#checkInError').empty()
                $('#checkOutError').empty()
                console.log(response.checkRoom)
            if (response.checkRoom.length != 0) {
                if ((parseInt(response.roomQty) - parseInt(response.BookingQty)) != 0) {
                    $.each(response.checkRoom, function(k,v){
                var maxquantity = 0;
                if (response.id ==  1) {
                    console.log(response.roomQty)
                    console.log(response.BookingQty)
                    maxquantity = parseInt(response.roomQty) - parseInt(response.BookingQty);
                } else if(response.id ==  2) {
                    maxquantity = v.r_quantity;
                }
                var pack = ''
                let room_id = v.r_id
                $.each(response.packages, function(k,v){
                     pack += '<div class="col-md-4"><section class="custom-section"><div><input type="radio" class="package" id="control_0'
                     +v.p_id+room_id+'" data-idpackage="'+room_id+'" onchange="radioChange('+v.p_additional_bed+', '+v.p_price+', '+room_id+')"  name="package" value="'
                     +v.p_price+'"><label for="control_0'+v.p_id+room_id+'" class="custom-label">'+v.p_name+'</label></div></section></div>'
                })
                var roomFirstPrice = v.r_price * response.days
                $('.rooms').append('<form id="CartForm" method="POST" action="{{ url('confirm-order')}}">@csrf<div class="card reservation-card"><div class="card-body"><div class="card reservation-card1"><div class="card-body"><div class="row"><div class="col-md-5"><img src="{{ asset('public/images/rooms')}}/'
                    +v.r_image+'" width="100%" alt=""></div><div class="col-md-7"><h2 class="room-name">'
                    +v.r_name+'</h2><span class="room-name">'+v.r_description+'</span></div></div><hr><div class="row">'
                    +pack+'<input type="radio" class="package unchecked" id="unchecked" name="package" value="0" checked><label for="unchecked" class="custom-label unchecked"></label></div><hr><div class="row"><div class="col-md-12"><div class="additionalRoom'+v.r_id+'"></div></div></div><br><div class="row"><div class="col-md-4">'
                    +'<input onchange="roomQuantityChange('+v.r_id+', '+v.r_price+', '+v.r_additional_bed+')" class="form-control roomQuantity roomQuantity2_'
                    +v.r_id+'" name="quantity" placeholder="Quantity" type="number" max="'
                    +maxquantity+'" data-id="'
                    +v.r_id+'" value="1" min="1" id="r_newquantity'
                    +v.r_id+'"></div><div class="col-md-3"></div><div class="col-md-5 align-middle"><span class="rates rates_'
                    +v.r_id+'"><small class="small">Room Rates: </small>Rs.'+roomFirstPrice+'/<small class="small">'+response.days+' Night</small></span></div><input type="hidden" id="rate" class="totalratebed_'
                    +v.r_id+'" name="ratebed" value="'
                    +v.r_price+'"><input type="hidden" id="rate" class="totalrate_'
                    +v.r_id+'" name="rate" value="'
                    +v.r_price+'"><input type="hidden" id="fixedrate_'
                    +v.r_id+'" name="fixedrate" value="'
                    +v.r_price+'"></div><div class="row rates"><div class="packageRate_'
                    +v.r_id+'"></div></div><div class="row rates"><div class="bedRate_'+v.r_id+'"></div></div><br><div class="row"><div class="col-md-4"></div><div class="col-md-3"></div><div class="col-md-5"><div id="TotalRate_'+v.r_id+'"><small class="totalrate1_'+v.r_id+'">Total Rates: </small>Rs.'+roomFirstPrice+'/<small class="small">'+response.days+' Night</small></div></div></div><br><div class="row"><div class="col-md-4"></div><div class="col-md-4"></div><div class="col-md-4 mobile-padding"><input type="hidden" name="id" value="'
                    +v.r_id+'" ><input type="hidden" value="'
                    +v.r_image+'" id="image'
                    +v.r_id+'" name="image"><input type="hidden" name="r_name" id="r_name'
                    +v.r_id+'" value="'
                    +v.r_name+'" ><input type="hidden" class="additionalPackage_'
                    +v.r_id+'" value="" name="additionalPackage"><input type="hidden" id="roomid" value="'
                    +v.r_id+'"><input type="hidden" class="TotalRoomRate_'
                    +v.r_id+'" name="TotalRoomRate" value="0"><input type="hidden" class="TotalBedRate_'
                    +v.r_id+'" name="TotalBedRate" value="0"><input type="hidden" class="TotalPackageRate_'
                    +v.r_id+'" name="TotalPackageRate" value="0"><input type="hidden" class="FinalTotal_'
                    +v.r_id+'" name="FinalTotal" value="0"><input type="hidden" id="additionalbed'
                    +v.r_id+'" name="additionalbed" data-roomid="'
                    +v.r_id+'" value="'
                    +v.r_additional_bed+'"><input type="hidden" name="checkIn" value="'
                    +response.checkIn+'"><input type="hidden" name="checkOut" value="'
                    +response.checkOut+'"><input type="hidden" name="packagerate" value="" id="packagerate"><input type="hidden" value="'
                    +response.days+'" id="days'
                    +v.r_id+'" name="days"><button type="submit" onClick="addToCart('
                    +v.r_id+')" class="btn btn-warning">Reserve</button></div></div></div></div></form>')
                })
                } else {
                    $('.rooms').append('<div class="alert alert-warning">Sorry! Room is not available.</div>')
                }
            } else {
                $('.rooms').append('<div class="alert alert-warning">Sorry! Room is not available.</div>')
            }
            }
            
            
        },
        complete:function(data){
            // Hide image container
            $("#searchLoader").hide();
        }
    });
}

// Room quantity
function roomQuantityChange(id, price, bedRate){
  roomQty = $('.roomQuantity2_'+id).val()
  var days = $(".rooms #days"+id).val()
  roomRates = (roomQty * price ) * parseInt(days)
  $('.rates_'+id).html('<small class="small">Room Rates: </small>Rs.'
                        + parseFloat(roomRates)
                        + '/<small class="small">'+days+' Night</small>')
  $('.rooms .TotalRoomRate_'+id).attr({"value":roomRates});                   

  $(".rooms .packageRate_"+id).empty()
  $(".rooms .additionalRoom"+id).empty()
  $(".rooms .bedRate").empty()
  totalBedRate = 0
  if (roomQty > 0) { 
      $(".rooms .additionalRoom"+id).append('<div class="row"><div class="col-md-12"><h3 class="room-name">Additional Bed</h3></div></div><div class="row">')
      for (i = 0; i < roomQty; i++) {
          $(".rooms .additionalRoom"+id).append('<div class="col-md-4" style="padding:5px;"><input type="number" class="form-control additionalbedquantity" min="0" name="bed[]" onChange="addBeds('+i+','+bedRate+',this, '+id+')" id="additionalbedquantity'+(i+1)+'" placeholder="Room number '+(i+1)+'"></div>')
      }
      $(".rooms .additionalRoom"+id).append('</div></br></br>')
  }
  radioChange(packageRate['bedRate'], packageRate['price'], id)
  calculateTotal(id)
}
// Add beds
function addBeds(id, bedRate, that, room_id){
  var days = $(".rooms #days"+room_id).val()
  let bedQty = $(that).val()
  let bedVal = (bedQty * bedRate) * parseInt(days)
  additionalBeds[id] = {
    'value': bedVal,
    'qty': bedQty
  }
  calBedRate(room_id)
  radioChange(packageRate['bedRate'], packageRate['price'], room_id)
  calculateTotal(room_id)
}
function calBedRate(room_id){
  let id = $(".rooms #roomid").val()
  var days = $(".rooms #days"+id).val()
  console.log(id)
  let bedTotal = 0
  $.each(additionalBeds, function(k, v){
    bedTotal += v.value
  })
  totalBedRate = bedTotal
  $('.rooms .TotalBedRate_'+room_id).attr({"value":totalBedRate});   
  $(".rooms .bedRate_"+room_id).html('<div class="col-md-4"></div><div class="col-md-3"></div><div class="col-md-5"><small class="small">Bed Rates :</small>Rs.'+totalBedRate+'/<small class="small">'+days+' Night</small></div>');

}
// Radio button
function radioChange(additionalBedRate, price, id){
  let totalBeds = 0
  let packageBedRate = 0
  var days = $(".rooms #days"+id).val()
  console.log(days)
  packageRate['price'] = price
  packageRate['bedRate'] = additionalBedRate

  $.each(additionalBeds, function(k,v){
    totalBeds += parseInt(v.qty)
  })
  packageBedRate = (parseInt(totalBeds) * parseInt(additionalBedRate)) * parseInt(days)
  if (roomQty > 0) {
    tempPackageRate = (parseInt(price) * roomQty) * parseInt(days)
  } else {
    tempPackageRate = parseInt(price) * parseInt(days)
  }
  
  totalPackageRate = parseInt(packageBedRate) + tempPackageRate
  $('.rooms .TotalPackageRate_'+id).attr({"value":totalPackageRate})
  $(".rooms .packageRate_"+id).html('<div class="col-md-4"></div><div class="col-md-3"></div><div class="col-md-5"><small class="small">Package Rates:</small>Rs.'+totalPackageRate+'/<small class="small">'+days+' Night</small></div>');
  calculateTotal(id)
}
// Calculate total
function calculateTotal(id){
    var days = $(".rooms #days"+id).val()
  let grandTotal = roomRates + totalBedRate + totalPackageRate
  $(".rooms .FinalTotal_"+id).attr({"value":grandTotal})
  $(".rooms #TotalRate_"+id).html('<small class="totalrate_'+id+'">Total Rates: </small>Rs.'+grandTotal+'/<small class="small">'+days+' Night</small>')
}
</script>
@endsection
