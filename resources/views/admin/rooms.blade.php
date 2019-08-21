@extends('layouts.admin')

@section('adminContent')
<section class="content">
    <div class="row main-padding">
        <h3>Rooms</h3>
    </div>
    <div class="row main-padding">
        <div class="col-md-4"></div>
        <div class="col-md-2" style="padding-bottom:5px;">
                <button type="button"  onclick="AddnewRoom()" class="btn btn-warning">Add new</button>
        </div>
        <div class="col-md-2">
            <button type="button" onclick="DeleteAllRoom()" class="btn btn-danger">Delete all</button>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
            <table id="Rooms" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price (Rs.)</th>
                <th>Quantity</th>
                <th>+ Bed price (Rs.)</th>
                <th>Actions</th>
              </tr>
              </thead>

              <tbody id="roomTable">
              @foreach ($room as $rooms)
                <tr>
                    <td><img src="{{ asset('public/images/rooms')}}/{{$rooms->r_image}}" width="50px"></td>
                    <td>{{$rooms->r_name}}</td>
                    <td>{{$rooms->r_price}}</td>
                    <td>{{$rooms->r_quantity}}</td>
                    <td>{{$rooms->r_additional_bed}}</td>
                    <td>
                        <a onclick="DeleteSingleRoom({{$rooms->r_id}})" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        <a onclick="EditRoom({{$rooms->r_id}})"  class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
              @endforeach
              </tbody>

              <tfoot>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>+ Bed price</th>
                <th>Actions</th>
              </tr>
              </tfoot>
            </table>
            </div>
          </div>
    </div>
</section>

@include('includes.roomModal')

<script>

    function AddnewRoom() {
        $('#exampleModalLongTitle').text('Add new room')
        $('#roomName').val('')
        $('#roomRate').val('')
        $('#roomQuantity').val('')
        $('#additionalBedRate').val('')
        $('.bd-newroom-modal-lg').modal('show')
    }
    
    $(document).ready( function () {
        $('#Rooms').DataTable( {
            responsive: true
        } );
    });

    $(document).ready(function (e) {
        $('#addNewRoom').on('submit',(function(e) {
        e.preventDefault()
        var NewRoom = new FormData(this)
        $.ajax({
            type: "POST",
            url: "{{ url('add-new-room')}}",
            data: NewRoom,
            cache:false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('.bd-newroom-modal-lg').modal('hide')
                $(".inputclear").val('');
                swal("Success!", "Added new room!", "success")
                $('#roomTable').empty()
                $.each(response.getRoom,function(k,v) { 
                    $('#roomTable').append('<tr><td><img src="{{ asset('public/images/rooms')}}/'
                    +v.r_image+'" width="50px"></td><td>'+v.r_name+'</td><td>'+v.r_price+'</td><td>'
                    +v.r_quantity+'</td><td>'+v.r_additional_bed+'</td><td><a onclick="DeleteSingleRoom('+v.r_id+')" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a><a href="{{ url('room-edit')}}/'
                    +v.r_id+'" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a></td></tr>')
                })
            }
        })
    }))
    })

    function DeleteAllRoom() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('delete-all-rooms')}}",
                    data : {'_method' : 'GET'},
                    success: function (response) {
                    $('#roomTable').empty()
                    $.each(response.getRoom,function(k,v) { 
                    $('#roomTable').append('<tr><td><img src="{{ asset('public/images/rooms')}}/'
                    +v.r_image+'" width="50px"></td><td>'+v.r_name+'</td><td>'+v.r_price+'</td><td>'
                    +v.r_quantity+'</td><td>'+v.r_additional_bed+'</td><td><a onclick="DeleteSingleRoom('
                    +v.r_id+')" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a><a href="{{ url('room-edit')}}/'
                    +v.r_id+'" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a></td></tr>')
                    })
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    })
            }
        })
        } else {
            swal("Your imaginary file is safe!");
        }
        })
    }

    function DeleteSingleRoom(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('room-delete')}}" + '/' + id,
                    data : {'_method' : 'GET'},
                    success: function (response) {
                        $('#roomTable').empty()
                        $.each(response.getRoom,function(k,v) { 
                            $('#roomTable').append('<tr><td><img src="{{ asset('public/images/rooms')}}/'
                            +v.r_image+'" width="50px"></td><td>'+v.r_name+'</td><td>'+v.r_price+'</td><td>'
                            +v.r_quantity+'</td><td>'+v.r_additional_bed+'</td><td><a onclick="DeleteSingleRoom('
                            +v.r_id+')" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a><a href="{{ url('room-edit')}}/'
                            +v.r_id+'" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a></td></tr>')
                        })
                    }
                });
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    }

    function EditRoom(id) {
        $.ajax({
            type: "GET",
            url: "{{ url('edit-room')}}"+ '/' + id,
            data : {'_method' : 'GET'},
            success: function (response) {
                $('#exampleModalLongTitle').text('Edit room')
                $('#roomName').val(response.r_name)
                $('#roomRate').val(response.r_price)
                $('#roomQuantity').val(response.r_quantity)
                $('#additionalBedRate').val(response.r_additional_bed)
                $('.bd-newroom-modal-lg').modal('show')
            }
        });
    }
</script>
@endsection 