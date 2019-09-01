@include('includes.adminHeader')
<style>

@media print {
  .hidden-print {
    display: none !important;
  }
  @page { size: auto;  margin: 0mm; }
}
.page {
    padding:50px;
    }
.i-box{
    color: #fff;
    font-weight: bold;
    
    background-color: #666666;
    padding: 10px;
    padding-top:17px;
}    
.thankYou{
    font-family: 'Pacifico', cursive;
    font-size: 70px;
}
.comeagain{
    font-family: 'Lexend Tera', sans-serif;
    font-size: 20px;
}
</style>
<link href="https://fonts.googleapis.com/css?family=Lexend+Tera|Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
<br>
@php
    date_default_timezone_set('Asia/Colombo');
@endphp
<center><button onclick="CreatePrint()" class="btn btn-danger hidden-print">Print</button></center>
    <div class="container" style="padding:30px;">
        <div class="row">
            <div class="col-4">
                <h1>INVOICE</h1>
            </div>
            <div class="col-4">
                <p>
                <center>
                   Issue Date : {{date("F j, Y, g:i a")}}
                </center></p>
            </div>
            <div class="col-4">
                <img class="float-right" src="{{ asset('public/images/logo.jpeg')}}" width="50px" alt="">
            </div>
        </div>
        <hr>
        <div class="page">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <p><b>Billed to:</b> <span id="CustomerId"></span> </P>
                {{$BillName}},<br>
                {{$BillCustomerCountry}},<br>
                {{$BillCustomerEmail}} <br>
                {{$BillCustomerContact}}
            </div>
            <div class="col-md-3 col-sm-3">
                <p><b>Arrival date:</b> <span id="CustomerId"></span> </P>
                {{$BillArrivalDate}}
            </div>
            <div class="col-md-3 col-sm-3">
                <p><b>Departure date:</b> <span id="CustomerId"></span> </P>
                {{$BillDepartureDate}}
            </div>
            <div class="col-md-3 col-sm-3">
                <p><b>Booking No:</b> <span id="CustomerId"></span> </P>
                {{$BillBookingId}}
            </div>
        </div>
        <br><br>
        <div class="row">
            <table width="100%" class="table table-bordered">
                <thead >
                    <tr>
                        <th style="width:70%">Description</th>
                        <th style="width:15%">Qty</th>
                        <th style="width:15%">Rate (Rs.)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="RoomDetails">
                        <td>{{$BillRoomName}}</td>
                        <td>{{$BillRoomQty}}</td>
                        <td>{{number_format($BillRoomRate,2)}}</td>
                    </tr>
                    @if ($BillPackageName != null)
                        <tr id="PackageDetails">
                            <td>{{$BillPackageName}}</td>
                            <td>-</td>
                            <td>{{number_format($BillPackageRate,2)}}</td>
                        </tr>
                    @endif
                    @if ($BillBedRate != null)
                    <tr id="AdditionalBedDetails">
                        <td>Additional Bed</td>
                        <td>{{$BillBedQty}}</td>
                        <td>{{number_format($BillBedRate,2)}}</td>
                    </tr>
                    @endif
                    @foreach ($billDetails as $item)
                    <tr id="OrdersDetails">
                        <td>{{$item->bill_pro_name}}</td>
                        <td>{{$item->bill_pro_qty}}</td>
                        <td>{{number_format($item->bill_pro_price,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><br><br>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-3"></div>
            <div class="col-5">
                <div class="i-box float-right">
                    <p>Invoice  Total: <span style="font-size:25px">Rs.{{number_format($OrdersGrandTotal,2)}}<span></p>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row" style="margin-top:100px">
            <div class="col-12">
                <center>
                    <span class="thankYou">
                        Thank You!
                    </span>
                    <br><br>
                    <span class="comeagain">
                        Come again
                    </span>
                </center>
            </div>
        </div>
       
    </div>
</div>   

<script>
    function CreatePrint() {
        window.print();
    }
    
</script>
@include('includes.adminFooter')