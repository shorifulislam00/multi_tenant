@extends('admin.layouts.app')

@section('title','Flat rent list')

@section('content')

<div class="app-main__inner">
    <div class="app-page-title">

        <div class="page-title-wrapper">
            <div class="page-title-heading" style="float:right;">
                Flat rent list
            </div>
        </div>

        <div class="" style="float: right ; margin-top: -35px !important;">
            <a class="btn-transition btn btn-success" href="javascript:void(0)" id="createNewFlat"> <i class="fas fa-plus mr-1"></i> Add New</a>
        </div>

        <div class="row">
            <div class="form-group d-flex justify-content-center col-md-12 ">
                <div class="col-md-3 col-lg-3 float-left">
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

                <div class="col-md-3 float-left">
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

                <div class="col-md-3 float-left">
                    <div class="form-group  row align-items-center" style="margin-top: 33px;">
                        <label for="flat_id" class="col-sm-3 col-form-label">Flat</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="flat_id" name="flat_id" aria-label="Default">
                                <option value="">Select</option>
                                @foreach ($flats as $flat)
                                    <option value="{{$flat->id}}">{{ $flat->flat_number }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mt-1 float-left">
                    <label for="search_btn" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;</label><br/>
                    <button  type="submit" style="margin-left: 50px;" class="btn-transition btn btn-success" id="search_btn"
                    onclick="searchData()"> <i class="fa fa-search"></i>
                    Search</button>
                </div>
            </div>

        </div>

    </div>

    <div class="row d-flex justify-content-center" style="margin-top: -65px">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body p-2">
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('House name') }}</th>
                                <th>{{ __('Floor name') }}</th>
                                <th>{{ __('Flat') }}</th>
                                <th>{{ __('Tenant name') }}</th>
                                <th>{{ __('Mobile number') }}</th>
                                <th>{{ __('Rent amount') }}</th>
                                <th>{{ __('Advance taka') }}</th>
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

<div class="modal fade" id="flatRentModelexa" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="flatRentForm" name="flatRentForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">

                    <div class="row">
                        <div class="col-lg-7">
                            <!-- First Row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                            <label for="select_house_id" class="control-label">House  <span style="color: red" >*</span> </label>
                                            <select class="form-select" aria-label="Default" id="select_house_id" name="select_house_id">
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
                                            <label class="control-label">Floor <span style="color: red" >*</span></label>
                                            <select class="form-select" aria-label="Default" id="select_floor_id" name="select_floor_id">
                                                <option value="">Select </option>
                                            </select>
                                            <span class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="select_flat_id" class="control-label">Flat <span style="color: red" >*</span> </label>
                                        <select class="form-select" id="select_flat_id" name="select_flat_id" aria-label="Default select example">
                                            <option value="">Select </option>
                                            {{--  @foreach ($flats as $flat)
                                                <option value="{{ $flat->id }}" >
                                                        {{ $flat->flat_number }}
                                                    </option>
                                                @endforeach
                                            --}}
                                        </select>
                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <!-- Your Flat Number Field -->
                                            <label for="tenant_name" class="control-label">Tenant name  <span style="color: red" >*</span></label>
                                            <div>
                                                <input type="text" class="form-control" id="tenant_name" name="tenant_name" placeholder="Enter name" value="" required>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label for="address" class="control-label">Tenant address</label>
                                            <div>
                                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="" required>
                                                <span class="text-danger"></span>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email Address </label>
                                        <div>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_no" class="control-label">Mobile number</label>
                                        <div>
                                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter name" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rent_date" class="control-label">Rental Date  <span style="color: red" >*</span></label>
                                        <div>
                                            <input  class="form-control" id="rent_date" name="rent_date" placeholder="DD-MM-YYYY" value="" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <!-- Your Flat Number Field -->
                                            <label for="rent_amount" class="control-label">Rent amount  <span style="color: red" >*</span></label>
                                            <div>
                                                <input type="text" class="form-control" id="rent_amount" name="rent_amount" placeholder="Enter amount" value="" required>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <!-- Your Flat Number Field -->
                                            <label for="meter_reading" class="control-label">Meter reading  <span style="color: red" >*</span></label>
                                            <div>
                                                <input type="text" class="form-control" id="meter_reading" name="meter_reading" placeholder="Enter reading" value="" required>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="advance" class="control-label">Advance Taka  <span style="color: red" >*</span></label>
                                        <div>
                                            <input type="text" class="form-control" id="advance" name="advance" placeholder="Enter amount" value="" required>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">


                                    <div class="form-group">
                                        <!-- Your Flat Type Field -->
                                        <label for="account_id" class="control-label">Account  <span style="color: red" >*</span> </label>
                                        <select class="form-select" id="account_id" name="account_id" aria-label="Default select example">
                                            <option value="">Select Account </option>
                                              @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}" >
                                                        {{ $account->name }}
                                                    </option>
                                                @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-5">
                            <section class="ftco-section">
                                <div class="container">

                                    <div class="row justify-content-center">
                                        <div style="margin-top: 1.7rem !important;" class="card p-2">
                                            <div class="wrap w-100">
                                                <div class="heading-title text-center">
                                                    <h5>Bills configuration</h5>
                                                    <hr>
                                                </div>
                                                <div class="">
                                                    <ul style="list-style-type: none" class="ks-cboxtags m-0">
                                                        @foreach ($billconfigs as $key => $billconfig)
                                                            <li style="display: flex; align-items: center;">
                                                                <input type="checkbox" id="billconfig{{ $billconfig->id }}" name="billconfig[]" value="{{ $billconfig->id }}">

                                                                <label for="billconfig{{ $billconfig->id }}" class="mx-2 mt-1">{{ $billconfig->name }}</label>

                                                                <input style="width: 100px; margin-left: auto; border-radius:5px; padding:2px;" type="text" id="amount{{ $billconfig->id }}" name="amount[]" placeholder="Enter amount">
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </div>


                        <!-- Buttons -->
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn-transition btn btn-primary " id="savedata" value="create"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Save</button>
                                <button type="submit" class="btn-transition btn btn-info " id="updatedata" value="update"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Update</button>
                                <button type="button" class="btn-transition btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-window-close ms-1" aria-hidden="true"></i> Close</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery.dataTables.min.css') }}">
@endsection

@section('scripts')

    <script src="{{ asset('backend/scripts/jquery-ui.js') }}" ></script>
    <script src="{{ asset('backend/scripts/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

<script>

    var table, house_id, floor_id, flat_id;

    $(document).ready(function() {

        $("#rent_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true
        });

        table = $('#table-data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('flatrent.index') }}",
                data: {house_id, floor_id, flat_id}
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
                    data: 'tenant_name',
                    name: 'tenant_name'
                },
                {
                    data: 'mobile_no',
                    name: 'mobile_no'
                },
                {
                    data: 'rent_amount',
                    name: 'rent_amount'
                },
                {
                    data: 'advance_amount',
                    name: 'advance_amount'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
    });


    // create new floor
    $('#createNewFlat').click(function () {
        $('#flatRentModelexa').modal({
            backdrop: 'static'
        });

        $("#id").val('');
        $("#select_house_id").val('');
        $("#select_floor_id").val('');
        $("#select_flat_id").val('');
        $("#tenant_name").val('');
        $("#mobile_no").val('');
        $("#address").val('');
        $("#email").val('');
        $("#rent_amount").val('');
        $("#meter_reading").val('');
        $("#advance").val('');


        $('#id').val('');
        $('#flatRentForm').trigger("reset");
        $('#modelHeading').html("Create New Rent");

        $(".form-control").removeClass('is-invalid');
        $(".text-danger").text('');

        $('#flatRentModelexa').modal('show');

        $('#savedata').show(); // Show Save button
        $('#updatedata').hide(); // Hide Update button
    });

     // save data
     $('#savedata').click(function (e) {
        e.preventDefault();
        $(this).html('Save');

        $.ajax({
          data: $('#flatRentForm').serialize(),
          url: "{{ route('flatrent.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (response) {

              $('#flatRentForm').trigger("reset");
              $('#flatRentModelexa').modal('hide');
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



     // edit user
     $('body').on('click', '.editFlatRent', function () {

        var id = $(this).data('id');
        $.get("{{ route('flatrent.index') }}" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Edit flat rent");
            $('#savedata').val("edit-flat-rent");
            console.log(data.flat_rents);
            $('#flatRentModelexa').modal('show');

            $('#id').val(data.flat_rents.id);
            $('#select_house_id').val(data.flat_rents.house_id);

            $('#account_id').val(data.flat_rents.tenant_ledger.account_id);
            $('#tenant_name').val(data.flat_rents.tenant_name);
            $('#rent_date').val(data.flat_rents.rent_date);
            $('#mobile_no').val(data.flat_rents.mobile_no);
            $('#email').val(data.flat_rents.email);
            $('#rent_amount').val(data.flat_rents.rent_amount);
            $('#meter_reading').val(data.flat_rents.meter_reading);
            $('#address').val(data.flat_rents.address);
            $('#advance').val(data.flat_rents.advance_amount);

            // __load in floors dropdown__ //
            $("#select_floor_id").html('<option value="">Select</option>');
            data.floors.forEach(function(item){
                $("#select_floor_id").append(`<option value="` + item.id + `">` + item.name + `</option>`);
            });

             // __load in flats dropdown__ //
            $("#select_flat_id").html('<option value="">Select</option>');
            data.flats.forEach(function(item){
                $("#select_flat_id").append(`<option value="` + item.id + `">` + item.flat_number + `</option>`);
            });

            $("#select_floor_id").val(data.flat_rents.floor_id);
            $("#select_flat_id").val(data.flat_rents.flat_id);

            // __load the checkbox value__ //
            $.each(data.flat_rents.rent_bill_configs, function(index, value) {
                $('#billconfig' + value.bill_config_id).prop('checked', true);
                $('#amount' + value.bill_config_id).val(value.amount);
            });
        })

        $('#savedata').hide(); // Hide Save button
        $('#updatedata').show();
     });

      // __update data__ //
      $('#updatedata').click(function (e) {
        e.preventDefault();


        var id = $('#id').val();

        $.ajax({
        data: $('#flatRentForm').serialize(),
        url: "{{ route('flatrent.update', ['flatrent' => ':id']) }}".replace(':id', id),
        type: "PUT",
        dataType: 'json',
        success: function (response) {

            $('#flatRentForm').trigger("reset");
            $('#flatRentModelexa').modal('hide');
            table.draw();

            if(response.status == 'success'){
                toastr.success(response.message);
            } else {
                toastr.error(response.message)
            }

            $(this).html('Update');

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

            $('#savedata').html('Update');
        }
    });
    });


    // __delete flat__ //
    $('body').on('click', '.deleteFlatRent', function () {

        var id = $(this).data("id");
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
                url: "{{ route('flatrent.store') }}"+'/'+id,
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




    // __change in house dropdown get floor__ //
        $('#select_house_id').on('change', function() {

            var houseId = $(this).val();
            $('#select_floor_id').empty().append('<option value="">Select Floor</option>');

            $.ajax({
                url: "{{ route('flatrent.getFloor', ':houseId') }}".replace(':houseId', houseId),
                type: 'GET',
                success: function(data) {
                    $.each(data.floors, function(key, value) {
                        $('#select_floor_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

        // __change in floor dropdown get flat__ //
        $('#select_floor_id').on('change', function() {
            var floorId = $(this).val();
            $('#select_flat_id').empty().append('<option value="">Select Flat</option>');

            $.ajax({
                url: "{{ route('flatrent.getFlat', ':floorId') }}".replace(':floorId', floorId),
                type: 'GET',
                success: function(data) {
                    $.each(data.flats, function(key, value) {
                        $('#select_flat_id').append('<option value="' + value.id + '">' + value.flat_number + '</option>');
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });


    // searching
    function searchData(){
        house_id = $("#house_id").val();
        floor_id = $("#floor_id").val();
        flat_id = $("#flat_id").val();
        //console.log(floor_id);
        $("#table-data").dataTable().fnSettings().ajax.data.house_id = house_id;
        $("#table-data").dataTable().fnSettings().ajax.data.floor_id = floor_id;
        $("#table-data").dataTable().fnSettings().ajax.data.flat_id = flat_id;
        table.ajax.reload();
    }


    // Show toast function
    function showToast() {
            toastr.success('Are you the 6 fingered man?');
            toastr.error('Are you the 6 fingered man?');
    }



</script>

@endsection
