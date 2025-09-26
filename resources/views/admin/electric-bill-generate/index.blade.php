@extends('admin.layouts.app')

@section('title','Bill Generate')

@section('content')
<div class="app-main__inner">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 px-1">
                <div class="card">
                    <div class="card-header">{{ __('Bill generate') }}</div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('bill.create')}}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="house_id" class="form-label">{{ __('House') }}</label>
                                    <select id="house_id" class="form-select" name="house_id" required>
                                        <option value="">Select</option>
                                        @foreach ($houses as $house )

                                            <option value="{{$house->id}}">{{ $house->name  }}</option>

                                        @endforeach
                                    </select>
                                </div>



                                 <div class="col-md-3">
                                    <label for="year_id" class="form-label">{{ __('Year') }}</label>
                                    <select name="year_id" id="year_id" class="form-select" required>
                                        <option value="">Select</option>

                                        @for($i = date('Y'); $i >= 2023; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor

                                    </select>

                                </div>

                                <div class="col-md-3">
                                    <label for="month_id" class="form-label">{{ __('Month') }}</label>
                                    <select name="month_id" id="month_id" class="form-select" required>
                                        <option value="">Select </option>

                                        @foreach($months as $key => $month)
                                            <option value="{{ $key }}">{{ $month }}</option>
                                        @endforeach

                                    </select>


                                </div>



                                <div class="col-md-2 mb-1 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-print me-1"></i>
                                        {{ __('Generate') }}
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
@endsection



