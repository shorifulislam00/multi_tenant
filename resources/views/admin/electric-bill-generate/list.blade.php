@extends('admin.layouts.app')

@section('title','Bill list')

@section('content')

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading" style="float:right; margin-top:-20px">
                Bill list
            </div>
        </div>

        <div class="row">
            <!--search  start -->
            <div class="form-group col-md-10 col-lg-12 mt-2 rounded">
                <div class="row mb-3">
                    <div class="col-md-2 col-lg-2">
                        <label for="house_id" class="form-label">{{ __('House') }}</label>
                        <select id="house_id" class="form-select" name="house_id" required>
                            <option value="">Select</option>
                            @foreach ($houses as $house )
                                <option value="{{$house->id}}">{{ $house->name  }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <label for="flat_id" class="form-label">{{ __('Flat') }}</label>
                        <select id="flat_id" class="form-select" name="flat_id" required>
                            <option value="">Select</option>

                        </select>
                    </div>


                     <div class="col-md-2 col-lg-2">
                        <label for="year_id" class="form-label">{{ __('Year') }}</label>
                        <select name="year_id" id="year_id" class="form-select" required>
                            <option value="">Select</option>
                            @for($i = date('Y'); $i >= 2023; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <label for="month_id" class="form-label">{{ __('Month') }}</label>
                        <select name="month_id" id="month_id" class="form-select" required>
                            <option value="">Select </option>
                            @foreach($months as $key => $month)
                                <option value="{{ $key }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <label for="is_paid" class="form-label">{{ __('Status') }}</label>
                        <select name="is_paid" id="is_paid" class="form-select" required>
                            <option value="">Select </option>

                                <option value="1">Paid</option>
                                <option value="0">Not Paid</option>

                        </select>
                    </div>

                    <div class="col-md-2 col-lg-2 float-left">
                        <label for="search_btn" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;</label><br/>
                            <button  type="submit" class="btn btn-transition btn-success" id="search_btn"
                            onclick="searchData()"> <i class="fa fa-search"></i>
                            Search</button>
                    </div>
                </div>
            </div>
        <!-- search  end -->
        </div>
    </div>
    <div class="row d-flex justify-content-center" style="margin-top:-60px;" >
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body p-2">
                    <table class="table table-striped table-responsive" id="table-data">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('House Name') }}</th>
                                <th>{{ __('Flat name/number') }}</th>
                                <th>{{ __('Tenant name') }}</th>
                                <th>{{ __('Month') }}</th>
                                <th>{{ __('Year') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Status') }}</th>
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
<div class="modal fade" id="billPaymentModelexa" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Bill Payment</h4>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="billPayment" name="billPayment" class="form-horizontal" enctype="multipart/form-data" method="POST" >
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <!-- First Row -->
                    <div class="row">

                        <div>
                            <strong id="month" >Month : </strong> <br>
                            <strong id="year" >Year : </strong><br>
                            <strong id="amount" >Total Amount : </strong>
                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label class="control-label">Account<span style="color:red; font-size:20px"> *</span></label>
                                <select class="form-select" aria-label="Default" id="account_id" name="account_id">
                                    <option value="">Select</option>
                                    @foreach ($accounts as $account)
                                    <option value="{{$account->id}}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label class="control-label">Payment date<span style="color:red; font-size:20px"> *</span></label>
                                <input  class="form-control" id="payment_date" name="payment_date" placeholder="DD-MM-YYYY" value="" required>
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="comment" class="control-label">Comment</label>
                                <div>
                                    <input type="text" class="form-control" id="comment" name="comment" placeholder="Enter comment" value="" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn-transition btn btn-primary " id="savedata" value="create"> <i class="fas fa-solid fa-file ms-1" aria-hidden="true"></i> Save</button>

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

        var table, house_id, flat_id, month_id, is_paid, year_id;

        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $(document).ready(function() {

            $("#payment_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true
            });

            table = $('#table-data').DataTable({


                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('bill.list') }}",
                    data: function (d) {
                        d.house_id = house_id;
                        d.flat_id = flat_id;
                        d.month_id = month_id;
                        d.year_id = year_id;
                        d.is_paid = is_paid;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'house_name',
                        name: 'house_name'
                    },
                    {
                        data: 'flat_name',
                        name: 'flat_name'
                    },
                    {
                        data: 'tenant_name',
                        name: 'tenant_name'
                    },


                    {
                        data: 'month_id',
                        name: 'month_id',
                        render: function(data, type, row) {
                            return months[data - 1];
                        }
                    },
                    {
                        data: 'year_id',
                        name: 'year_id'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },

                    {
                        data: 'is_paid',
                        name: 'is_paid',
                        render: function(data, type, row) {
                            return data == 1 ? '<span class="badge badge-success">Paid</span>' : '<span class="badge badge-danger">Not Paid</span>';
                        }
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });

            // __delete expense transanction data__ //
            $('body').on('click', '.deleteBill', function() {
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
                            url: "{{ route('bill.store') }}" + '/' + id,
                            success: function(response) {
                                table.draw();

                                if (response.status == 'success') {
                                    toastr.success(response.message);
                                } else {
                                    toastr.error(response.message)
                                }

                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });

                        Swal.fire('Deleted!', 'Your item has been deleted.', 'success');

                    }
                });
            });



            $('#house_id').change(function() {
                var selectedHouseId = $(this).val();
                $('#flat_id').empty().append('<option value="">Select</option>');
                if (selectedHouseId) {
                    $.ajax({
                        url: "{{ route('getFlatsByHouse') }}",
                        type: 'POST',
                        data: {
                            house_id: selectedHouseId
                        },
                        success: function(response) {
                            $.each(response.flats, function(key, flat) {
                                $('#flat_id').append('<option value="' + flat.id + '">' + flat.flat_number + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });





        });


        $(document).on('click', '.billPayment', function() {

            $('#billPaymentModelexa').modal('show');

            var id = $(this).data('id');

            console.log(id);

            $.get("{{ url('bill-payment') }}" + '/' + id , function(data) {
                $('#amount').text('Total Amount: ' + data.amount);
                $('#month').text('Month: ' + months[data.month_id - 1]);
                $('#year').text('Year: ' + data.year_id);
                $('#id').val(data.id);
            });

        });

        $('#billPayment').submit(function(e) {
            e.preventDefault();

            var id = $('#id').val();

            console.log(id);

            $.ajax({
                type: "POST",
                url: "{{ url('bill/update_payment') }}/" + id ,
                data: $(this).serialize(),
                success: function(response) {
                    table.draw();

                    $('#billPaymentModelexa').modal('hide');
                    toastr.success(response.message);
                },
                error: function(data) {

                    toastr.error('Failed to update payment');
                }
            });
        });





        function searchData() {
            house_id = $("#house_id").val();
            flat_id = $("#flat_id").val();
            month_id = $("#month_id").val();
            year_id = $("#year_id").val();
            is_paid = $("#is_paid").val();

          //  console.log(house_id,flat_id, month_id, year_id);

            $("#table-data").dataTable().fnSettings().ajax.data.house_id = house_id;
            $("#table-data").dataTable().fnSettings().ajax.data.flat_id = flat_id;
            $("#table-data").dataTable().fnSettings().ajax.data.month_id = month_id;
            $("#table-data").dataTable().fnSettings().ajax.data.year_id = year_id;
            $("#table-data").dataTable().fnSettings().ajax.data.is_paid = is_paid;

            table.ajax.reload();
        }




    </script>
@endsection




