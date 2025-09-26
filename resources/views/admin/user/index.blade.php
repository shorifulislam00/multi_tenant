@extends('admin.layouts.app')

@section('title','User list')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">

            <div class="page-title-wrapper">
                <div class="page-title-heading" style="float:right;">
                    User list
                </div>
            </div>

            <div class="" style="float: right ; margin-top: -35px !important;">
                <a class="btn-transition btn btn-success" href="{{ route('user.create') }}" > <i class="fas fa-plus mr-1"></i> Add New</a>
            </div>

            @include('admin.layouts.message')

        </div>



        <div class="row d-flex justify-content-center" style="margin-top: -25px">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body p-2">
                        <table class="table table-striped" id="table-data">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
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
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // $('#createNewUser').click(function(){
            //     $('#userModelexa').modal({
            //         backdrop: 'static'
            //     });
            // });

            // // create new user
            // $('#createNewUser').click(function () {
            //     $('#savedata').val("create-user");
            //     $('#id').val('');
            //     $('#userForm').trigger("reset");
            //     $('#modelHeading').html("Create New User");

            //     $(".form-control").removeClass('is-invalid');
            //     $(".text-danger").text('');

            //     $('#userModelexa').modal('show');

            //     $('#savedata').show(); // Show Save button
            //     $('#updatedata').hide(); // Hide Update button

            // });

            // // edit user
            // $('body').on('click', '.editUser', function () {
            //     var id = $(this).data('id');
            //     //console.log(id);

            //     $.get("{{ route('user.index') }}" +'/' + id +'/edit', function (data) {
            //         $('#modelHeading').html("Edit User");
            //         $('#savedata').val("edit-user");
            //         $('#userModelexa').modal('show');
            //         $('#id').val(data.id);
            //         $('#name').val(data.name);
            //         $('#email').val(data.email);
            //         $('#password').val(data.password);

            //         $('#savedata').hide(); // Show Save button
            //         $('#updatedata').show(); // Hide Update button
            //     })
            //  });


            // // save data
            // $('#savedata').click(function (e) {
            //     e.preventDefault();
            //     $(this).html('Sending..');

            //     $.ajax({
            //       data: $('#userForm').serialize(),
            //       url: "{{ route('user.store') }}",
            //       type: "POST",
            //       dataType: 'json',
            //       success: function (response) {

            //           $('#userForm').trigger("reset");
            //           $('#userModelexa').modal('hide');
            //           table.draw();

            //           if(response.status == 'success'){
            //             toastr.success(response.message);
            //         } else {
            //             toastr.error(response.message)
            //         }


            //       },
            //       error: function (data) {
            //         if (data.status === 422) {
            //             var errors = data.responseJSON.errors;
            //             $('.text-danger').text('');
            //             $.each(errors, function (key, value) {
            //                 $('#' + key).addClass('is-invalid');
            //                 $('#' + key).siblings('.text-danger').text(value);
            //             });
            //         }
            //           $('#savedata').html('Save');
            //       }
            //   });
            // });

            // $('#updatedata').click(function (e) {
            //     e.preventDefault();
            //     $('.text-danger').text('');
            //     $.ajax({
            //       data: $('#userForm').serialize(),
            //       url: "{{ route('user.update', ['user' => ':id']) }}".replace(':id', $('#id').val()),
            //       type: "PUT",
            //       dataType: 'json',
            //       success: function (response) {
            //         $('#userForm').trigger("reset");
            //         $('#userModelexa').modal('hide');
            //         table.draw();
            //         if(response.status == 'success'){
            //             toastr.success(response.message);
            //         } else {
            //             toastr.error(response.message)
            //         }
            //       },
            //       error: function (data) {
            //         if (data.status === 422) {
            //             var errors = data.responseJSON.errors;
            //             $('.text-danger').text('');
            //             $.each(errors, function (key, value) {
            //                 $('#' + key).addClass('is-invalid');
            //                 $('#' + key).siblings('.text-danger').text(value);
            //             });
            //         }
            //           $('#savedata').html('Update');
            //       }
            //   });
            // });

            // // delete data
            $('body').on('click', '.deleteUser', function () {

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
                        url: "{{ route('user.store') }}"+'/'+id,
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




    </script>
@endsection
