@extends('admin.layouts.app')

@section('title','Floor list')

@section('content')

<div class="app-main__inner" style="margin-top: -40px">
    <div class="app-page-title">
        <div class="row ">
            <!--search  start -->
            <div class="form-group col-md-12 rounded">
                <div class="col-md-2 mt-3 float-left">
                    <h3>FLoor list</h3>
                </div>

                <div style="margin-left: 50px;" class="col-md-4 float-left">
                    <div class="form-group  row align-items-center" style="margin-top: 33px;">
                        <label for="house_id" class="col-sm-3 col-form-label">House</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="house_id" name="house_id" aria-label="Default">
                                <option value="">Select</option>
                                @foreach ($houses as $house)
                                    <option value="{{$house->id}}">{{ $house->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="col-md-2 mt-1 float-left">
                    <label for="search_btn" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;</label><br/>
                    <button  type="submit" style="margin-left: 50px;" class="btn-transition btn btn-success" id="search_btn"
                    onclick="searchData()"> <i class="fa fa-search"></i>
                    Search</button>
                </div>

                <div class="col-md-3 mt-3 float-left">
                        <div class="d-flex justify-content-right p-2" style="float: right;margin-top:9px;
                        margin-right:-60px;">
                            <a class="btn-transition btn btn-success" href="javascript:void(0)" id="createNewFloor" > <i class="fas fa-plus mr-1"></i> Add New</a>
                        </div>
                </div>
            </div>
        <!-- search  end -->
        </div>
    </div>

    <div class="row d-flex justify-content-center" style="margin-top: -60px">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body p-2">
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('House name') }}</th>
                                <th>{{ __('Floor name') }}</th>
                                <th width="">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
<div class="modal fade" id="floorModelexa" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal"></button>

            </div>
            <div class="modal-body">
                <form id="floorForm" name="floorForm" class="form-horizontal" enctype="multipart/form-data">
                   <input type="hidden" name="id" id="id">
                   <div class="form-group">
                        <label for="select_house_id" class="control-label">House Name <strong class="text-warning">*</strong> </label>

                        <select class="form-select form-control" id="select_house_id" name="select_house_id">
                            <option value="">Select House </option>

                            @foreach ($houses as $house)
                                <option value="{{ $house->id }}" >
                                    {{ $house->name }}
                                </option>
                            @endforeach

                        </select>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="name" class="control-label">Floor name <strong class="text-warning">*</strong></label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter floor name" value="" required>
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="text-center col-sm-12">
                        <button type="submit" class="btn-transition btn btn-primary " id="savedata" value="create"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Save</button>
                        <button type="submit" class="btn-transition btn btn-info " id="updatedata" value="update"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Update</button>
                        <button type="button" class="btn-transition btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-window-close ms-1" aria-hidden="true"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery.dataTables.min.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('backend/scripts/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>

    var table , house_id;

    $(document).ready(function() {

       // $("#house_id").select2();

        table = $('#table-data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('floor.index') }}",
                data: {house_id}
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'house',
                    name: 'house'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });

    // create new floor
    $('#createNewFloor').click(function () {

        $('#floorModelexa').modal({
            backdrop: 'static'
        });

        $("#id").val('');
        $("#select_house_id").val('');
        $("#name").val('');



        $('#savedata').val("create-floor");
        $('#id').val('');
        $('#floorForm').trigger("reset");
        $('#modelHeading').html("Create New Floor");

        $(".form-control").removeClass('is-invalid');
        $(".text-danger").text('');

        $('#floorModelexa').modal('show');

        $('#savedata').show(); // Show Save button
        $('#updatedata').hide(); // Hide Update button

    });

     // edit user
     $('body').on('click', '.editFloor', function () {

        var id = $(this).data('id');

        $.get("{{ route('floor.index') }}" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Edit Floor");
            $('#savedata').val("edit-floor");
            $('#floorModelexa').modal('show');
            $('#id').val(data.id);
            $('#select_house_id').val(data.house_id);
            $('#name').val(data.name);

            $('#savedata').hide(); // Show Save button
            $('#updatedata').show(); // Hide Update button

        })
     });

    function readURL(input, previewElement) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(previewElement).attr('src', e.target.result).show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


      // save data
    $('#savedata').click(function (e) {
        e.preventDefault();
        // $(this).html('Sending

        var formData = $("#floorForm").serializeArray();

        var requestData = new FormData();

        $.each(formData, function(key, input) {
            requestData.append(input.name, input.value);
        });

        $.ajax({
            data: requestData,
            url: "{{ route('floor.store') }}",
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType:false,
            success: function (response) {
                $('#floorForm').trigger("reset");
                $('#floorModelexa').modal('hide');
                table.draw();


                if(response.status == 'success'){
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message)
                }


            },
            error: function (data) {

                if (data.status === 422) {
                    var errors = data.responseJSON.errors;
                    $('.text-danger').text('');
                    $.each(errors, function (key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key).siblings('.text-danger').text(value);
                    });
                }
                $('#savedata').html('Save');
            }
        });
    });

    $('body').on('click', '.deleteFloor', function () {

        var id = $(this).data("id");
        // console.log(id);

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this item!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

              $.ajax({
                type: "DELETE",
                url: "{{ route('floor.store') }}"+'/'+id,
                success: function (response) {
                    table.draw();

                if(response.status == 'success'){
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message)
                }

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

            Swal.fire('Deleted!', 'Your item has been deleted.', 'success');

            }
          });
    });


    // __ search house__ //
    function searchData(){
        house_id = $("#house_id").val();
        //console.log(house_id);
        $("#table-data").dataTable().fnSettings().ajax.data.house_id = house_id;
        table.ajax.reload();
    }



</script>

@endsection
