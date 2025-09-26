@extends('admin.layouts.app')

@section('title','Payment List')

@section('content')

<div class="app-main__inner">
    <div class="app-page-title" style="margin-top: -70px;">
        <div class="row my-1 mt-2 ">
            <div class="col-lg-12 rounded">
                <div class=" p-2" style="float:left;">
                    <h4>Bill Payment List</h4>
                </div>

            </div>
        </div>
        <hr style="margin-top: 0px;">
        <div class="row ">
            <!--search  start -->
            <div class="form-group col-md-12 rounded">
                <div class="col-md-3 float-left">
                    <div class="form-group">
                        <label class="control-label">Flat </label>
                        <select class="form-select" aria-label="Default" id="flat_rent_id" name="flat_rent_id">
                            <option value="">Select</option>

                            @foreach ($flatrents as $flatrent)
                                <option value=" {{$flatrent->id}} ">
                                    {{ $flatrent->flat->flat_number }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-3 float-left">
                    <label class="control-label">From date</label>
                    <input class="form-control" id="from_date" name="from_date"
                        value="{{ request('from_date') }}" placeholder="DD-MM-YYYY"/>
                </div>

                <div class="col-md-3 float-left">
                    <label class="control-label">To date</label>
                    <input  class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}" placeholder="DD-MM-YYYY"/>
                </div>

                <div class="col-md-3 float-left">
                    <label for="search_btn" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;</label><br/>
                        <button style="margin-left: 100px" type="submit" class="btn px-4 btn-success" id="search_btn"
                        onclick="searchData()"> <i class="fa fa-search"></i>
                        Search</button>
                </div>
            </div>
        <!-- search  end -->
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
                                <th>{{ __('Payment Date') }}</th>
                                <th>{{ __('Flat name/number') }}</th>
                                <th>{{ __('Year') }}</th>
                                <th>{{ __('Month') }}</th>
                                <th>{{ __('Account') }}</th>
                                <th>{{ __('Amount') }}</th>
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

    var table, flat_rent_id, from_date, to_date;

    $(document).ready(function() {


        $("#from_date, #to_date").datepicker({
            dateFormat: "dd-mm-yy"
        });

        table = $('#table-data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('bill-payment-list.index') }}",
                data: {flat_rent_id, from_date, to_date}
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'action_date',
                    name: 'action_date'
                },
                {
                    data: 'flat_number',
                    name: 'flat_number'
                },
                {
                    data: 'year_id',
                    name: 'year_id'
                },
                {
                    data: 'month_id',
                    name: 'month_id',
                    render: function(data, type, row) {

                        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                        return months[data - 1];
                    }
                },
                {
                    data: 'account',
                    name: 'account'
                },
                {
                    data: 'cr',
                    name: 'cr'
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



    // delete payment
    $('body').on('click', '.deleteBillPayment', function () {

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
                url: "{{ route('bill-payment-list.store') }}"+'/'+id,
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




        // searching
        function searchData(){
            flat_rent_id = $("#flat_rent_id").val();
            from_date = $("#from_date").val();
            to_date = $("#to_date").val();
            //console.log(from_date);
            $("#table-data").dataTable().fnSettings().ajax.data.flat_rent_id = flat_rent_id;
            $("#table-data").dataTable().fnSettings().ajax.data.from_date = from_date;
            $("#table-data").dataTable().fnSettings().ajax.data.to_date = to_date;
            table.ajax.reload();
        }

</script>

@endsection
