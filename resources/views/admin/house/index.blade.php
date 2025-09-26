@extends('admin.layouts.app')

@section('title','Houses list')



@section('content')

<div class="app-main__inner">
    <div class="app-page-title">

        <div class="page-title-wrapper">
            <div class="page-title-heading" style="float:right;">
                House list
            </div>
        </div>

        <div class="" style="float: right ; margin-top: -35px !important;">
            <a class="btn-transition btn btn-success" href="javascript:void(0)" id="createNewHouse"> <i class="fas fa-plus mr-1"></i> Add New</a>
        </div>

    </div>
    <div class="row d-flex justify-content-center" style="margin-top: -25px">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body p-2">
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Start date') }}</th>
                                <th>{{ __('House name') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Address') }}</th>

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
<div class="modal fade" id="houseModelexa" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="POST" id="houseForm" name="houseForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="house_name" class="control-label">House name <strong class="text-warning">*</strong> </label>
                                <input type="text" required class="form-control" id="house_name" name="house_name" placeholder="Enter name" value="{{ old('house_name') }}">
                                <span class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="domestic_electric_bill" class="control-label">Domestic electric rate</label>
                                <input type="text" class="form-control" id="domestic_electric_bill" name="domestic_electric_bill" placeholder="Enter rate" value="" >
                            </div>

                            <div class="form-group">
                                <label class="control-label">Address <strong class="text-warning">*</strong></label>
                                <input type="text"  class="form-control" id="address" name="address" placeholder="Enter address" value="" >
                                <span class="text-danger"></span>
                            </div>


                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Start Date</label>
                                <input class="form-control" id="start_date" name="start_date" placeholder="DD-MM-YYYY" value="" >
                            </div>
                            <div class="form-group">
                                <label for="business_electric_bill" class="control-label">Business electric rate</label>
                                <input type="text" class="form-control" id="business_electric_bill" name="business_electric_bill" placeholder="Enter rate" value="" >
                            </div>



                            <div class="form-group">
                                <label for="description" class="control-label">Description</label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>

                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-12 mt-3 text-center">
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
        $(document).ready(function() {
            $("#start_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true
            });

            var table = $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('house.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });




            // create new house
             $('#createNewHouse').click(function () {

                $('#houseModelexa').modal({
                    backdrop: 'static'
                });

                $('#savedata').val("create-house");
                $('#id').val('');
                $('#houseForm').trigger("reset");
                $('#modelHeading').html("Create New House");

                $(".form-control").removeClass('is-invalid');
                $(".text-danger").text('');

                $('#houseModelexa').modal('show');

                $('#savedata').show(); // Show Save button
                $('#updatedata').hide(); // Hide Update button
            });

            // edit house
            $('body').on('click', '.editHouse', function () {

                var id = $(this).data('id');
                $.get("{{ route('house.index') }}" +'/' + id +'/edit', function (data) {
                    $('#modelHeading').html("Edit House");
                    $('#savedata').val("edit-house");
                    $('#houseModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#house_name').val(data.name);
                    $('#description').val(data.description);
                    $('#address').val(data.address);
                    $('#start_date').val(data.start_date);
                    $('#business_electric_bill').val(data.business_electric_bill);
                    $('#domestic_electric_bill').val(data.domestic_electric_bill);

                    $('#savedata').hide(); // Show Save button
                    $('#updatedata').show(); // Hide Update button
                })
            });

             // save data
             $('#savedata').click(function (e) {
                e.preventDefault();

                $('.text-danger').text('');

                $.ajax({
                  data: $('#houseForm').serialize(),
                  url: "{{ route('house.store') }}",
                  type: "POST",
                  dataType: 'json',
                  success: function (response) {

                    $('#houseForm').trigger("reset");
                    $('#houseModelexa').modal('hide');

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

            $('#updatedata').click(function (e) {
                e.preventDefault();
                $('.text-danger').text('');
                $.ajax({
                  data: $('#houseForm').serialize(),
                  url: "{{ route('house.update', ['house' => ':id']) }}".replace(':id', $('#id').val()),
                  type: "PUT",
                  dataType: 'json',
                  success: function (response) {
                    $('#houseForm').trigger("reset");
                    $('#houseModelexa').modal('hide');
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
                      $('#savedata').html('Update');
                  }
              });
            });


            // delete data
            $('body').on('click', '.deleteHouse', function () {

                var id = $(this).data("id");

                // __sweetalert__ //
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
                        url: "{{ route('house.store') }}"+'/'+id,
                        success: function (response) {
                            table.draw();

                        if(response.status == 'success'){
                            toastr.success(response.message);
                            Swal.fire('Deleted!', 'Your item has been deleted.', 'success');
                        } else {
                            toastr.error(response.message)
                        }

                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });



                    }
                  });


            });

        });




    </script>
@endsection

