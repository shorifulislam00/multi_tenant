@extends('admin.layouts.app')


@section('title', 'Bill category')

@section('content')

<div class="app-main__inner">
    <div class="app-page-title">
        @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
        @endif

        <div class="page-title-wrapper">
            <div class="page-title-heading" style="float:right;">
                Bill category list
            </div>
        </div>

        <div class="" style="float: right ; margin-top: -35px !important;">
            <a class="btn btn-transition btn-success" href="javascript:void(0)" id="createNewBillCategory"> <i class="fas fa-plus mr-1"></i> Add New</a>
        </div>

    </div>
    <div class="row d-flex justify-content-center" style="margin-top: -25px">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body p-2">
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th width="200px">{{ __('#') }}</th>
                                <th width="600px" >{{ __('Bill category') }}</th>
                                <th width="150px">{{ __('Action') }}</th>
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

<div class="modal fade" id="billCategoryModelexa" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="btn-close  mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="billCategoryForm" name="billCategoryForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id">

                    <div class="form-group mb-4">
                        <label for="bill_category_name" class="control-label">Bill category <span style="color:red; font-size:20px"> *</span> </label>
                        <div class="">
                            <input type="text" class="form-control" id="bill_category_name" name="bill_category_name" placeholder="Enter category" value="" required>
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="text-center">
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

        $(document).ready(function() {


            var table = $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('bill-category.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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



         // create new bill config
        $('#createNewBillCategory').click(function () {

            $('#billCategoryModelexa').modal({
                backdrop: 'static'
            });

            $("#id").val('');
            $("#bill_category_name").val('');

            $('#savedata').val("create-bill-category");
            $('#id').val('');
            $('#houseForm').trigger("reset");
            $('#modelHeading').html("Create bill category");

            $(".form-control").removeClass('is-invalid');
            $(".text-danger").text('');

            $('#billCategoryModelexa').modal('show');

            $('#savedata').show(); // Show Save button
            $('#updatedata').hide(); // Hide Update button
        });

         // edit bill category
         $('body').on('click', '.editBillConfig', function () {

            var id = $(this).data('id');
            $.get("{{ route('bill-category.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Edit bill category");
                $('#savedata').val("edit-bill-category");
                $('#billCategoryModelexa').modal('show');
                $('#id').val(data.id);
                $('#bill_category_name').val(data.name);

                $('#savedata').hide(); // Show Save button
                $('#updatedata').show(); // Hide Update button

            })
        });

          // save data
        $('#savedata').click(function (e) {
            e.preventDefault();


            $.ajax({
                data: $('#billCategoryForm').serialize(),
                url: "{{ route('bill-category.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {

                    $('#billCategoryForm').trigger("reset");
                    $('#billCategoryModelexa').modal('hide');
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

        // delete bill category
        $('body').on('click', '.deleteBillConfig', function () {

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
                    url: "{{ route('bill-category.store') }}"+'/'+id,
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
