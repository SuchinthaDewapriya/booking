@extends('layouts.admin')

@section('adminContent')
<section class="content">
    <div class="row main-padding">
        <h3>Packages</h3>
    </div>
    <div class="row main-padding">
        <div class="col-md-4"></div>
        <div class="col-md-2" style="padding-bottom:5px;">
                <button type="button"  onclick="AddnewPackage()" class="btn btn-warning">Add new</button>
        </div>
        <div class="col-md-2">
            <button type="button" onclick="DeleteAllPackage()" class="btn btn-danger">Delete all</button>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
            <table id="Packages" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Name</th>
                <th>Price (Rs.)</th>
                <th>+ Bed price (Rs.)</th>
                <th>Actions</th>
              </tr>
              </thead>

              <tbody id="packageTable">
              @foreach ($Package as $Packages)
                <tr>
                    <td>{{$Packages->p_name}}</td>
                    <td>{{$Packages->p_price}}</td>
                    <td>{{$Packages->p_additional_bed}}</td>
                    <td>
                        <a onclick="DeleteSinglePackage({{$Packages->p_id}})" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        <a onclick="EditPackage({{$Packages->p_id}})"  class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
              @endforeach
              </tbody>

              <tfoot>
              <tr>
                <th>Name</th>
                <th>Price (Rs.)</th>
                <th>+ Bed price (Rs.)</th>
                <th>Actions</th>
              </tr>
              </tfoot>
            </table>
            </div>
          </div>
    </div>
</section>

@include('includes.packageModal')

<script>

    function AddnewPackage() {
        $('#exampleModalLongTitle').text('Add new package')
        $('#packageName').val('')
        $('#packageRate').val('')
        $('#packageQuantity').val('')
        $('#additionalBedRate').val('')
        $('.bd-newpackage-modal-lg').modal('show')
    }
    
    $(document).ready( function () {
        $('#Packages').DataTable( {
            responsive: true
        } );
    });

    $(document).ready(function (e) {
        $('#addNewPackage').on('submit',(function(e) {
        e.preventDefault()
        var NewPackage = new FormData(this)
        $.ajax({
            type: "POST",
            url: "{{ url('add-new-package')}}",
            data: NewPackage,
            cache:false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('.bd-newpackage-modal-lg').modal('hide')
                $(".inputclear").val('');
                swal("Success!", "Added new package!", "success")
                $('#packageTable').empty()
                $.each(response.getPackage,function(k,v) { 
                    $('#packageTable').append('<tr><td>'+v.p_name+'</td><td>'+v.p_price+'</td><td>'
                      +v.p_additional_bed+'</td><td><a onclick="DeleteSinglePackage('
                        +v.p_id+')" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a><a href="{{ url('package-edit')}}/'
                    +v.p_id+'" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a></td></tr>')
                })
            }
        })
    }))
    })

    function DeleteAllPackage() {
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
                    url: "{{ url('delete-all-packages')}}",
                    data : {'_method' : 'GET'},
                    success: function (response) {
                    $('#packageTable').empty()
                    $.each(response.getPackage,function(k,v) { 
                    $('#packageTable').append('<tr><td>'+v.p_name+'</td><td>'+v.p_price+'</td><td>'+v.p_additional_bed+'</td><td><a onclick="DeleteSinglePackage('
                    +v.p_id+')" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a><a href="{{ url('package-edit')}}/'
                    +v.p_id+'" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a></td></tr>')
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

    function DeleteSinglePackage(id) {
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
                    url: "{{ url('package-delete')}}" + '/' + id,
                    data : {'_method' : 'GET'},
                    success: function (response) {
                        $('#packageTable').empty()
                        $.each(response.getPackage,function(k,v) { 
                            $('#packageTable').append('<tr><td>'+v.p_name+'</td><td>'+v.p_price+'</td><td>'+v.p_additional_bed+'</td><td><a onclick="DeleteSinglePackage('
                            +v.p_id+')" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a><a href="{{ url('package-edit')}}/'
                            +v.p_id+'" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a></td></tr>')
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

    function EditPackage(id) {
        $.ajax({
            type: "GET",
            url: "{{ url('edit-package')}}"+ '/' + id,
            data : {'_method' : 'GET'},
            success: function (response) {
                $('#exampleModalLongTitle').text('Edit package')
                $('#packageName').val(response.p_name)
                $('#packageRate').val(response.p_price)
                $('#packageQuantity').val(response.p_quantity)
                $('#additionalBedRate').val(response.p_additional_bed)
                $('.bd-newpackage-modal-lg').modal('show')
            }
        });
    }
</script>
@endsection 