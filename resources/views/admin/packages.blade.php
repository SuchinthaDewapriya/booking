@extends('layouts.admin')

@section('adminContent')
<section class="content">
    <div class="row main-padding">
        <h3>Packages</h3>
    </div>
    <div class="row main-padding">
        <div class="col-md-4"></div>
        <div class="col-md-2" style="padding-bottom:5px;">
            <a href="" class="btn btn-warning">Add new</a>
        </div>
        <div class="col-md-2">
            <a href="" class="btn btn-danger">Delete all</a>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="card-body">
            <table id="Packages" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Trident</td>
                <td>Internet
                  Explorer 4.0
                </td>
                <td>Win 95+</td>
                <td> 4</td>
                <td>X</td>
              </tr>
              <tr>
                <td>Other browsers</td>
                <td>All others</td>
                <td>-</td>
                <td>-</td>
                <td>U</td>
              </tr>
              </tbody>
              <tfoot>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
              </tr>
              </tfoot>
            </table>
          </div>
    </div>
</section>
<script>
    $(document).ready( function () {
    $('#Packages').DataTable();
} );
    
  </script>
@endsection 