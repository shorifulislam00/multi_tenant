@extends('admin.layouts.app')

@section('title','Bill Ledger')



@section('content')

<div class="app-main__inner">
    <div class="app-page-title">

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Bill Ledger') }}</div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('bill.ledger.print') }}" target="_blank">

                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="party_id" class="col-form-label text-md-right">{{ __('Flat Rent') }}</label>

                                        <select id="flat_rent_id" type="flat_rent_id" class="form-select @error('flat_rent_id') is-invalid @enderror" name="flat_rent_id"  >
                                            <option value="">Select</option>

                                            @foreach ($flat_rents as $flat_rent)
                                                <option value="{{ $flat_rent->id }}" data-address="{{ $flat_rent->address }}" >
                                                    {{ $flat_rent->tenant_name }}
                                                </option>
                                            @endforeach

                                        </select><br/>



                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from_date" class="col-form-label text-md-right">{{ __('From Date') }}</label>

                                        <input placeholder="DD-MM-YYYY" id="from_date" type="text" class="form-control" name="from_date" />

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="to_date" class="col-form-label text-md-right">{{ __('To Date') }}</label>

                                        <input placeholder="DD-MM-YYYY" id="to_date" type="text" class="form-control" name="to_date" />

                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
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

            $("#flat_rent_id").select2();
        });



    </script>
@endsection
