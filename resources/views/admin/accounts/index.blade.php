@extends('admin.layouts.app')

@section('title','Accounts - list')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">

        <div class="page-title-wrapper">
            <div class="page-title-heading" style="float:right;">
                Accounts list
            </div>
        </div>

        <div class="" style="float: right ; margin-top: -35px !important;">
            <a class="btn btn-success" href="javascript:void(0)" id="createNewAccount"> <i class="fas fa-plus mr-1"></i> Add New</a>
        </div>

    </div>
    <div class="row d-flex justify-content-center" style="margin-top: -25px">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body p-2">
                    <table class="table table-striped " id="table-data">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Account name') }}</th>
                                <th>{{ __('Account number') }}</th>
                                <th>{{ __('Branch name') }}</th>
                                <th>{{ __('Opening balance') }}</th>
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
<div class="modal fade" id="accountModelexa" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="btn-close btn-warning mt-1" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form id="accountForm" name="accountForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account_name" class="control-label">Account name <span style="color:red; font-size:20px"> *</span> </label>
                                <div>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Enter name" value="" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="acc_number" class="control-label">Account number<span style="color:red; font-size:20px"> *</span></label>
                                <div>
                                    <input type="text" class="form-control" id="acc_number" name="acc_number" placeholder="Enter number" value="" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>



                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="control-label">Opening balance<span style="color:red; font-size:20px"> *</span></label>
                                <div>
                                    <input type="text" class="form-control" id="opening_balance" name="opening_balance" placeholder="Enter amount" value="" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 25px;">
                                <label class="control-label">Branch name</label>
                                <div>
                                    <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter branch " value="" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn-transition btn btn-primary " id="savedata" value="create"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Save</button>
                        <button type="submit" class="btn-transition btn btn-info" id="updatedata" value="update"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Update</button>
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

        $(document).ready(function() {

            var table = $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('account.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'acc_number',
                        name: 'acc_number'
                    },
                    {
                        data: 'branch_name',
                        name: 'branch_name'
                    },
                    {
                        data: 'balance',
                        name: 'balance'

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

             // __create new account__ //
            $('#createNewAccount').click(function () {

                $('#accountModelexa').modal({
                    backdrop: 'static'
                });

                $('#savedata').val("create-account");
                $('#id').val('');
                $('#accountForm').trigger("reset");
                $('#modelHeading').html("Create New Account");

                $(".form-control").removeClass('is-invalid');
                $(".text-danger").text('');

                $('#accountModelexa').modal('show');

                $('#savedata').show(); // Show Save button
                $('#updatedata').hide(); // Hide Update button
            });

            // __edit account__  //
            $('body').on('click', '.editAccount', function () {

                var id = $(this).data('id');
                $.get("{{ route('account.index') }}" +'/' + id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Account");
                    $('#savedata').val("edit-account");
                    $('#accountModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#account_name').val(data.name);
                    $('#acc_number').val(data.acc_number);
                    $('#branch_name').val(data.branch_name);
                    $('#opening_balance').val(data.opening_balance);

                    // Show/hide buttons
                    $('#savedata').hide();
                    $('#updatedata').show();
                })
            });



             // __new account data save__ //
             $('#savedata').click(function (e) {
                e.preventDefault();


                $.ajax({
                  data: $('#accountForm').serialize(),
                  url: "{{ route('account.store') }}",
                  type: "POST",
                  dataType: 'json',
                  success: function (response) {
                      $('#accountForm').trigger("reset");
                      $('#accountModelexa').modal('hide');
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

              // __new account data save__ //
              $('#updatedata').click(function (e) {
                e.preventDefault();


                $.ajax({
                  data: $('#accountForm').serialize(),
                  url: "{{ route('account.update', ['account' => ':id']) }}".replace(':id', $('#id').val()),
                  type: "PUT",
                  dataType: 'json',
                  success: function (response) {
                      $('#accountForm').trigger("reset");
                      $('#accountModelexa').modal('hide');
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

            // delete data
            $('body').on('click', '.deleteAccount', function () {

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
                        url: "{{ route('account.store') }}"+'/'+id,
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

        });

        // Show toast function
        function showToast() {
            toastr.success('Are you the 6 fingered man?');
            toastr.error('Are you the 6 fingered man?');
        }

    </script>





@endsection
