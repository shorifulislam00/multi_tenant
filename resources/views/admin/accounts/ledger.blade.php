@extends('admin.layouts.app')

@section('title','Account ledger')



@section('content')

<div class="app-main__inner">
    <div class="app-page-title">

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('account ledger') }}</div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('account.ledger.print') }}" target="_blank">

                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="account_id" class="col-form-label text-md-right">{{ __('Account') }}</label>

                                        <select id="account_id"  class="form-select @error('account_id') is-invalid @enderror" name="account_id"  required>
                                            <option value="">Select</option>

                                            @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}"  >
                                                    {{ $account->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from_date" class="col-form-label text-md-right">{{ __('From Date') }}</label>

                                        <input  id="from_date" type="text" class="form-control" name="from_date" placeholder="DD-MM-YYYY" />

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="to_date" class="col-form-label text-md-right">{{ __('To Date') }}</label>

                                        <input  id="to_date" type="text" class="form-control" name="to_date" placeholder="DD-MM-YYYY" />

                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12  text-center mt-3 ">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-print"></i>
                                        {{ __('Print') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- [ Main Content ] end -->

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
        $(document).ready( function () {
            $("#from_date, #to_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true
            });

            $("#account_id").select2();
        });


        function showAddress(){
            let address = $("#account_id").find(':selected').data('address');

            $("#show_address").html("Address :  " + address);
        }
    </script>
@endsection
