@extends('layouts.admin')

@section('adminContent')
<section class="content">
    <div class="row main-padding">
      <h3>Reservations</h3>
    </div>
    <div class="row">
        <div class="card-body">
            <table id="Rooms" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Booking Id</th> 
                <th>Room Name</th>
                <th>In Date</th>
                <th>Out Date</th>
                <th>Rooms</th>
                <th>Total Rate</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($Booking as $item)
                  <tr @if($item->b_status == 2) class="bg-success" @endif>
                    <td>{{$item->b_id}}</td> 
                    <td>{{$item->r_name}}</td> 
                    <td>{{$item->b_checkindate}}</td>
                    <td>{{$item->b_checkoutdate}}</td>
                    <td>{{$item->b_rquantity}}</td>
                    <td>Rs.{{$item->br_totalRate}}</td>
                    <td>
                      @if ($item->b_status == 0) 
                        <span class="badge badge-warning">Pending</span> 
                      @endif
                      @if ($item->b_status == 1) 
                        <span class="badge badge-success">Confirm</span>
                      @endif
                      @if ($item->b_status == 2 ) 
                        <span class="badge badge-secondary">Live</span>
                      @endif
                    </td>
                    <td>
                      <a onclick="ViewReservation({{$item->b_id}}, {{$item->b_package}})" class="btn btn-sm btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      @if ($item->b_status == 0) 
                        <a href="{{ url('confirm-book')}}/{{$item->b_id}}" class="btn btn-sm btn-success" title="Confirm"><i class="fa fa-check" aria-hidden="true"></i></a> 
                      @endif
                      @if($item->b_status == 1) 
                        <a href="{{ url('live')}}/{{$item->b_id}}" class="btn btn-sm btn-secondary" title="Live"><i class="fa fa-flag" aria-hidden="true"></i></a> 
                      @endif
                      @if($item->b_status == 2) 
                        <a href="{{ url('Orders')}}/{{$item->b_id}}" class="btn btn-sm btn-warning" title="Orders"><i class="fa fa-plus" aria-hidden="true"></i></a> 
                      @endif
                      <a href="" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                  <th>Booking Id</th>
                  <th>Room Name</th>
                  <th>In Date</th>
                  <th>Out Date</th>
                  <th>Rooms</th>
                  <th>Total Rate</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              </tfoot>
            </table>
          </div>
    </div>
</section>
@include('includes.ViewReservationModal')

<script>
    $(document).ready( function () {
    $('#Rooms').DataTable();
} );
    function ViewReservation(id, package) {
      $.ajax({
            type: "GET",
            url: "{{ url('view-reservation')}}"+ '/' + id + '/' + package,
            data : {'_method' : 'GET'},
            success: function (response) {
                $('#CustomerName').empty();
                $('#CustomerId').empty();
                $('#ArrivalDate').empty();
                $('#DepartureDate').empty();
                $('#CustomerEmail').empty();
                $('#CustomerContact').empty();
                $('#CustomerCountry').empty();
                $('#CustomerNote').empty();
                $('.Bill').empty();
                
                let Name = response.ViewReservation.customerdetails.cd_salutation +' '+response.ViewReservation.customerdetails.cd_first_name +' '+ response.ViewReservation.customerdetails.cd_last_name
                $('#CustomerName').append(Name)
                $('#CustomerId').append(response.ViewReservation.b_id) 
                $('#ArrivalDate').append(response.ViewReservation.b_checkindate) 
                $('#DepartureDate').append(response.ViewReservation.b_checkoutdate) 

                $('#CustomerEmail').append(response.ViewReservation.customerdetails.cd_email)
                $('#CustomerContact').append(response.ViewReservation.customerdetails.cd_phone)
                $('#CustomerCountry').append(response.ViewReservation.customerdetails.cd_country)
                $('#CustomerNote').append(response.ViewReservation.customerdetails.cd_note)

                let RoomRate = parseInt(response.ViewReservation.bookingrate.br_roomRate)
                let BedRate = parseInt(response.ViewReservation.bookingrate.br_bedmRate) 
                
                $('.Bill').append('<tr><td style="width:70%">'+response.ViewReservation.room.r_name+'</td><td style="width:15%">'
                +response.ViewReservation.b_rquantity+'</td><td style="width:15%">Rs.'
                +RoomRate+'</td></tr>')

                if (response.packageCheck != 0) {
                  $('.Bill').append('<tr><td style="width:70%">'+response.packageCheck+'</td><td style="width:15%"></td><td style="width:15%">Rs.'
                  +response.ViewReservation.bookingrate.br_packageRate+'</td></tr>')
                } 
                if (response.BedTotalQty != 0) {
                  $('.Bill').append('<tr><td style="width:70%">Additional Bed</td><td style="width:15%">'
                  +response.BedTotalQty+'</td><td style="width:15%">Rs.'
                  +BedRate+'</td></tr>')
                }               
                $('.Bill').append('<tr><td style="width:70%"></td><td style="width:15%"><b>Total Rate</b></td><td style="width:15%"><b>Rs.'
                +response.ViewReservation.bookingrate.br_totalRate+'</b></td></tr>')
                
                $('.bd-viewReservation-modal-lg').modal('show')
            }
        });
    } 
  </script>
@endsection 