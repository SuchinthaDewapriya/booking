@extends('layouts.admin')

@section('adminContent')

<section class="content">
        <div class="row main-padding">
                <h3>Reservations</h3>
              </div>
              <div class="row main-padding">
                <a href="{{ url('customer-pdf')}}" class="btn btn-success">Monthly Report</a>
              </div>
              <div class="row">
                  <div class="card-body">
                      <table id="Customers" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>Id</th> 
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact No</th>
                          <th>Country</th>
                        </tr>
                        </thead>
                        <tbody id="ReservationsTable">
                          @foreach ($Customer as $Customers)
                            <tr>
                                <td>{{$Customers->cd_id}}</td>
                                <td>{{$Customers->cd_salutation}} {{$Customers->cd_first_name}} {{$Customers->cd_last_name}}</td>
                                <td>{{$Customers->cd_email}}</td>
                                <td>{{$Customers->cd_phone}}</td>
                                <td>{{$Customers->cd_country}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                                <th>Id</th> 
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Country</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
              </div>
</section>

<script>
$(document).ready( function () {
      $('#Customers').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
      $('#Rooms').DataTable();
    });
</script>
@endsection