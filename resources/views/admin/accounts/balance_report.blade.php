@extends('admin.layouts.app')

@section('title','Accounts Balance - list')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">

        <div class="page-title-wrapper">
            <div class="page-title-heading" style="float:right;">
                Accounts Current Balance Report
            </div>
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
                                <th>{{ __('Balance') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->acc_number }}</td>
                                    <td>{{ $item->branch_name }}</td>
                                    <td>{{ number_format($item->balance, 0, '.', ',') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

