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
                  <tr>
                    <td>{{$item->b_id}}</td> 
                    <td>{{$item->r_name}}</td> 
                    <td>{{$item->b_checkindate}}</td>
                    <td>{{$item->b_checkoutdate}}</td>
                    <td>{{$item->b_rquantity}}</td>
                    <td>Rs.{{$item->br_totalRate}}</td>
                    <td>@if ($item->b_status == 0) <span class="badge badge-warning">Pending</span> @else @endif</td>
                    <td>
                      <a onclick="ViewReservation({{$item->b_id}})" class="btn btn-sm btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      @if ($item->b_status == 0) <a href="" class="btn btn-sm btn-success" title="Confirm"><i class="fa fa-check" aria-hidden="true"></i></a> @endif
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
    function ViewReservation(id) {
      $.ajax({
            type: "GET",
            url: "{{ url('view-reservation')}}"+ '/' + id,
            data : {'_method' : 'GET'},
            success: function (response) {
                // $('#updateRoomId').val(response.r_id)
                // $('#UpdateroomName').val(response.r_name)
                // $('#UpdateroomRate').val(response.r_price)
                // $('#UpdateroomQuantity').val(response.r_quantity)
                let Name = response.cd_salutation +' '+response.cd_first_name +' '+ response.cd_last_name
                $('#CustomerName').append(Name)
                $('#CustomerEmail').append(response.ViewReservation.cd_email)
                $('#CustomerContact').append(response.ViewReservation.cd_phone)
                $('#CustomerCountry').append(response.ViewReservation.cd_country)
                $('#CustomerNote').append(response.ViewReservation.cd_note)

                $('.bd-viewReservation-modal-lg').modal('show')
            }
        });
    }
  </script>
@endsection 