@extends('admin.layouts.app')

@section('title','Flat list')

@section('content')

<div style="margin-top: -20px;" class="app-main__inner">
    <div class="app-page-title">

        <div class="page-title-wrapper">
            <div class="page-title-heading" style="float:right;">
                Flats list
            </div>
        </div>

        <div class="" style="float: right ; margin-top: -35px !important;">
            <a class="btn-transition btn btn-success" href="javascript:void(0)" id="createNewFlat"> <i class="fas fa-plus mr-1"></i> Add New</a>
        </div>

        <div class="row  ">

            <div class="form-group d-flex justify-content-center col-md-12 ">
                <div class="col-md-4 float-left">
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

                <div class="col-md-4 float-left">
                    <div class="form-group  row align-items-center" style="margin-top: 33px;">
                        <label for="floor_id" class="col-sm-3 col-form-label">Floor</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="floor_id" name="floor_id" aria-label="Default">
                                <option value="">Select</option>
                                @foreach ($floors as $floor)
                                    <option value="{{$floor->id}}">{{ $floor->name }}</option>
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
            </div>

        </div>

    </div>
    <div class="row d-flex justify-content-center" style="margin-top: -70px">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body p-2">
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('House name') }}</th>
                                <th>{{ __('Floor name') }}</th>
                                <th>{{ __('Flat number') }}</th>
                                <th>{{ __('Flat type') }}</th>

                                <th>{{ __('Squre feet') }}</th>
                                <th>{{ __('Sell rate') }}</th>
                                <th>{{ __('Rent amount') }}</th>
                                <th>{{ __('Action') }}</th>
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

<div class="modal fade" id="flatModelexa" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="flatForm" name="flatForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">

                    <!-- First Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Your Select House Field -->

                                    <label class="control-label">House <span style="color:red; font-size:20px"> *</span></label>
                                    <select class="form-select" aria-label="Default" id="house_name" name="house_name">
                                        <option value="">Select House </option>
                                            @foreach ($houses as $house)
                                                <option value="{{ $house->id }}" >
                                                    {{ $house->name }}
                                                </option>
                                            @endforeach
                                    </select>
                                    <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Your Select Floor Field -->

                                    <label for="floor_name" class="control-label">Floor
                                        <span style="color:red; font-size:20px"> *</span>
                                    </label>
                                    <select class="form-select" aria-label="Default" id="floor_name" name="floor_name">
                                        <option value="">Select  </option>
                                           {{--  @foreach ($floors as $floor)
                                                <option value="{{ $floor->id }}" >
                                                    {{ $floor->name }}
                                                </option>
                                            @endforeach
                                            --}}
                                    </select>
                                    <span class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Your Flat Type Field -->
                                <label for="flat_type" class="control-label">Flat type</label>
                                <select class="form-select" id="flat_type" name="flat_type" aria-label="Default select example">
                                    <option value="">Select type</option>
                                    <option value="shop">Shop</option>
                                        <option value="apartment">Apartment</option>
                                </select>
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <!-- Your Flat Number Field -->
                                    <label for="flat_number" class="control-label">Flat number</label>
                                    <div>
                                        <input type="text" class="form-control" id="flat_number" name="flat_number" placeholder="Enter number" value="" required>
                                        <span class="text-danger"></span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <!-- Your Description Field -->
                                    <label for="description" class="control-label">Description</label>
                                    <div>
                                        <textarea  id="description" name="description" class="form-control" placeholder=""></textarea>
                                    </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="squre_feet" class="control-label">Flat - squre feet </label>
                                <div>
                                    <input type="text" class="form-control" id="squre_feet" name="squre_feet" placeholder="Enter area" value="" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sell_rate" class="control-label">Flat sell rate</label>
                                <div>
                                    <input type="text" class="form-control" id="sell_rate" name="sell_rate" placeholder="Enter rate" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="rent_amount" class="control-label">Flat rent amount</label>
                                <div>
                                    <input type="text" class="form-control" id="rent_amount" name="rent_amount" placeholder="Enter amount" value="" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn-transition btn btn-primary " id="savedata" value="create"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Save</button>
                            <button type="submit" class="btn-transition btn btn-info " id="updatedata" value="update"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Update</button>
                            <button type="button" class="btn-transition btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-window-close ms-1" aria-hidden="true"></i> Close</button>
                        </div>
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

    var table, house_id, floor_id;

    $(document).ready(function() {

        table = $('#table-data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('flat.index') }}",
                data: {house_id, floor_id}
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
                    data: 'floor',
                    name: 'floor'
                },
                {
                    data: 'flat_number',
                    name: 'flat_number'
                },
                {
                    data: 'type',
                    name: 'type'
                },

                {
                    data: 'sqr_feet',
                    name: 'sqr_feet'
                },
                {
                    data: 'sell_rate',
                    name: 'sell_rate'
                },
                {
                    data: 'rent_amount',
                    name: 'rent_amount'
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
    $('#createNewFlat').click(function () {

        $('#flatModelexa').modal({
            backdrop: 'static'
        });


        $("#id").val('');
        $("#house_name").val('');
        $("#floor_name").val('');
        $("#flat_type").val('');
        $("#flat_number").val('');
        $("#description").val('');
        $("#squre_feet").val('');
        $("#sell_rate").val('');
        $("#rent_amount").val('');


        $('#id').val('');
        $('#flatForm').trigger("reset");
        $('#modelHeading').html("Create New Flat");

        $(".form-control").removeClass('is-invalid');
        $(".text-danger").text('');

        $('#flatModelexa').modal('show');

        $('#savedata').show(); // Show Save button
        $('#updatedata').hide(); // Hide Update button

    });

     // edit user
     $('body').on('click', '.editFlat', function () {

        var id = $(this).data('id');
        $.get("{{ route('flat.index') }}" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Edit flat");
            $('#savedata').val("edit-flat");
            $('#flatModelexa').modal('show');

            $('#id').val(data.flats.id);
            $('#house_name').val(data.flats.house_id);
            $('#flat_type').val(data.flats.type);
            $('#flat_number').val(data.flats.flat_number);
            $('#description').val(data.flats.description);
            $('#squre_feet').val(data.flats.sqr_feet);
            $('#sell_rate').val(data.flats.sell_rate);
            $('#rent_amount').val(data.flats.rent_amount);

            // __get load floor data__ //
            $("#floor_name").html('<option value="">Select</option>');
            data.floors.forEach(function(item){
                $("#floor_name").append(`<option value="` + item.id + `">` + item.name + `</option>`);
            });
            $("#floor_name").val(data.flats.floor_id);


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


    //   // save data
    $('#savedata').click(function (e) {
        e.preventDefault();
        // $(this).html('Sending..');

        var formData = $("#flatForm").serializeArray();
        var requestData = new FormData();

        $.each(formData, function(key, input) {
            requestData.append(input.name, input.value);
        });

        $.ajax({
            data: requestData,
            url: "{{ route('flat.store') }}",
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType:false,
            success: function (response) {
                $('#flatForm').trigger("reset");
                $('#flatModelexa').modal('hide');
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

    // delete flat
    $('body').on('click', '.deleteFlat', function () {

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
                url: "{{ route('flat.store') }}"+'/'+id,
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

    // change in house dropdown
        $('#house_name').on('change', function() {

            var houseId = $(this).val();

            $('#floor_name').empty();
            $('#floor_name').append('<option value="">Select </option>');

            $.ajax({

               // url: "/getFloors/"+houseId,
                url: "{{ route('flat.getFloor_house', ':houseId') }}".replace(':houseId', houseId),
                type: 'GET',
                success: function(data) {
                    $.each(data.floors, function(key, value) {
                        $('#floor_name').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });


        // searching
        function searchData(){
            house_id = $("#house_id").val();
            floor_id = $("#floor_id").val();
            //console.log(floor_id);
            $("#table-data").dataTable().fnSettings().ajax.data.house_id = house_id;
            $("#table-data").dataTable().fnSettings().ajax.data.floor_id = floor_id;
            table.ajax.reload();
        }


        // Show toast function
        function showToast() {
            toastr.success('Are you the 6 fingered man?');
            toastr.error('Are you the 6 fingered man?');
        }
</script>

@endsection
