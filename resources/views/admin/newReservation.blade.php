@extends('layouts.admin')

@section('adminContent')

<section class="content">
    <div class="row main-padding">
        <h3>New Reservations</h3>
    </div>
    <form id="checkForm"> 
        @csrf
    <div class="row main-padding">
        <div class="col-md-4">
            <div class="form-group">
                <label for="my-textarea">Arrival Date</label> 
                <input type="date" name="checkIn" id="checkIn"  class="form-control">
            </div><br>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="my-textarea">Departure Date</label>
                <input type="date" name="checkOut" id="checkOut"  class="form-control" >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="my-textarea" > </label>
                <input type="button" onClick="Check()" class="btn btn-primary btn-block" value="Check">
            </div>
        </div>
    </div>
    </form>
    <div class="row main-padding">
        <div class="col-md-12">
        <center>
            <div id='searchLoader' style='display: none;'>
                <img src='{{ asset('public/images/dataloader.gif') }}'>
            </div>
        </center>
        <form method="post" id="BookingForm">@csrf
        <div class="rooms">
        </div>
        <div id="checkInError"></div>
        <div id="checkOutError"></div>
    </div>
    </div>
    <div class="row main-padding">
        <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <center><h2>Customer Details</h2>  </center><hr>
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

</section>

<script type="text/javascript">
    var packagePrice = {}
    var packageBRate = {}
    var packageRate = {
      'price': 0,
      'bedRate': 0
    }
    var additionalBeds = {}
    var roomRates = {}
    var roomQty = {}
    var totalBedRate = {}
    var totalPackageRate = {}
    
    
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
                if (response.checkRoom.length != 0) {
                    $('.rooms').append('<div class="row">')

                    if ((parseInt(response.roomQty) - parseInt(response.BookingQty)) != 0) {
                    $.each(response.checkRoom, function(k,v){
                    var maxquantity = 0;
                    if (response.id ==  1) {
                        maxquantity = parseInt(response.roomQty) - parseInt(response.BookingQty);
                    } else if(response.id ==  2) {
                        maxquantity = v.r_quantity;
                    }
                    var pack = ''
                    let room_id = v.r_id
                    $.each(response.packages, function(k,v){
                         pack += '<div class="col-md-12"><section class="custom-section"><div><input type="radio" class="package" id="control_0'
                         +v.p_id+room_id+'" data-idpackage="'+room_id+'" onchange="radioChange('+v.p_additional_bed+', '+v.p_price+', '+room_id+')"  name="package" value="'
                         +v.p_price+'"><label for="control_0'+v.p_id+room_id+'" class="custom-label">'+v.p_name+'</label></div></section></div>'
                    })
                    var roomFirstPrice = v.r_price * response.days
                    $('.rooms').append('<div class="col-md-6"><form id="CartForm" method="POST" action="{{ url('confirm-order')}}">@csrf<div class="card reservation-card"><div class="card-body"><div class="card reservation-card1"><div class="card-body"><div class="row"><div class="col-md-5"><img src="{{ asset('public/images/rooms')}}/'
                        +v.r_image+'" width="100%" alt=""></div><div class="col-md-7"><h2 class="room-name">'
                        +v.r_name+'</h2><span class="room-name">'+v.r_description+'</span></div></div><hr><div class="row">'
                        +pack+'<input type="radio" class="package unchecked" id="unchecked" name="package" value="0" checked><label for="unchecked" class="custom-label unchecked"></label></div><hr><div class="row"><div class="col-md-12"><div class="additionalRoom'+v.r_id+'"></div></div></div><br><div class="row"><div class="col-md-12">'
                        +'<input onchange="roomQuantityChange('+v.r_id+', '+v.r_price+', '+v.r_additional_bed+')" class="form-control roomQuantity roomQuantity2_'
                        +v.r_id+'" name="quantity" placeholder="Quantity" type="number" max="'
                        +maxquantity+'" data-id="'
                        +v.r_id+'" value="" min="1" id="r_newquantity'
                        +v.r_id+'"></div><input type="hidden" id="rate" class="totalratebed_'
                        +v.r_id+'" name="ratebed" value="'
                        +v.r_price+'"><input type="hidden" id="rate" class="totalrate_'
                        +v.r_id+'" name="rate" value="'
                        +v.r_price+'"><input type="hidden" id="fixedrate_'
                        +v.r_id+'" name="fixedrate" value="'
                        +v.r_price+'"></div><div class="row rates"><div class="packageRate_'
                        +v.r_id+'"></div></div><div class="row rates"><div class="bedRate_'+v.r_id+'"></div></div><br><div class="row"><div class="col-md-12"><div id="TotalRate_'+v.r_id+'"><small class="totalrate1_'+v.r_id+'">Total Rates: </small>Rs.'+roomFirstPrice+'/<small class="small">'+response.days+' Night</small></div></div></div><br><div class="row"><div class="col-md-4 mobile-padding"><input type="hidden" name="id" value="'
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
                        +v.r_id+')" class="btn btn-warning">Reserve</button></div></div></div></div></form></div>')
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
        
        checkPackageValue(id)
      roomQty[id] = $('.roomQuantity2_'+id).val()
      var days = $(".rooms #days"+id).val()
      roomRates[id] = (roomQty[id] * price ) * parseInt(days)
      $('.rooms .TotalRoomRate_'+id).attr({"value":roomRates[id]});                   
    
      $(".rooms .packageRate_"+id).empty()
      $(".rooms .additionalRoom"+id).empty()
      $(".rooms .bedRate").empty()
      totalBedRate[id] = 0
      if (roomQty[id] > 0) { 
          $(".rooms .additionalRoom"+id).append('<div class="row"><div class="col-md-12"><h3 class="room-name">Additional Bed</h3></div></div><div class="row">')
          for (i = 0; i < roomQty[id]; i++) {
              $(".rooms .additionalRoom"+id).append('<div class="col-md-12" style="padding:5px;"><input type="number" class="form-control additionalbedquantity" min="0" name="bed[]" onChange="addBeds('+i+','+bedRate+',this, '+id+')" id="additionalbedquantity'+(i+1)+'" placeholder="Room number '+(i+1)+'"></div>')
          }
          $(".rooms .additionalRoom"+id).append('</div>')
      }
      radioChange(packagePrice[id], packageBRate[id], id)
      calculateTotal(id)
    
    }
    // Add beds
    function addBeds(id, bedRate, that, room_id){
        checkPackageValue(room_id)
      var days = $(".rooms #days"+room_id).val()
      let bedQty = $(that).val()
      let bedVal = (bedQty * bedRate) * parseInt(days)
      additionalBeds[id] = {
        'value': bedVal,
        'qty': bedQty
      }
      calBedRate(room_id)
      radioChange(packagePrice[room_id], packageBRate[room_id], room_id)
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
      totalBedRate[room_id] = bedTotal
      $('.rooms .TotalBedRate_'+room_id).attr({"value":totalBedRate[room_id]});   
    
    }
    // Radio button
    function radioChange(additionalBedRate, price, id){
      checkPackageValue(id)
      let totalBeds = 0
      let packageBedRate = 0
      var days = $(".rooms #days"+id).val()
      packageRate['price'] = price
      packageRate['bedRate'] = additionalBedRate
      packagePrice[id] = price
      packageBRate[id] = additionalBedRate
    
      $.each(additionalBeds, function(k,v){
        totalBeds += parseInt(v.qty)
      })
      packageBedRate = (parseInt(totalBeds) * parseInt(additionalBedRate)) * parseInt(days)
      if (roomQty[id] > 0) {
        tempPackageRate = (parseInt(price) * roomQty[id]) * parseInt(days)
      } else {
        tempPackageRate = parseInt(price) * parseInt(days)
      }
      
      totalPackageRate[id] = parseInt(packageBedRate) + tempPackageRate
      $('.rooms .TotalPackageRate_'+id).attr({"value":totalPackageRate[id]})
      calculateTotal(id)
    }
    // Calculate total
    function calculateTotal(id){
        var days = $(".rooms #days"+id).val()
      let grandTotal = roomRates[id] + totalBedRate[id] + totalPackageRate[id]
      $(".rooms .FinalTotal_"+id).attr({"value":grandTotal})
      $(".rooms #TotalRate_"+id).html('<small class="totalrate_'+id+'">Total Rates: </small>Rs.'+grandTotal+'/<small class="small">'+days+' Night</small>')
    //   console.log('---')
    //   console.log(roomRates)
    // console.log(roomQty)
    // console.log(totalBedRate)
    // console.log(totalPackageRate)
    // console.log('package---')
    // console.log(packagePrice)
    // console.log(packageBRate)
    }
    
    function checkPackageValue(id){
        // console.log(objectHasKey(packagePrice, id))
        if($.isEmptyObject(packagePrice) || !objectHasKey(packagePrice, id)){
            packagePrice[id] = 0
        }
        if($.isEmptyObject(packageBRate) || !objectHasKey(packageBRate, id)){
            packageBRate[id] = 0
        }
    }
    
    function objectHasKey(obj, key){
        // let k = Object.keys(obj)
        if(obj.hasOwnProperty(key)){
            return true
        }
        return false
    }
    </script>
@endsection