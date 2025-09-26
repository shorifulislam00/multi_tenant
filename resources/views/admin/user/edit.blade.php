@extends('admin.layouts.app')

@section('title','User list')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">

            <div class="page-title-wrapper">
                <div class="page-title-heading" style="float:right;">
                    New User
                </div>
            </div>



        </div>
        <div class="row d-flex justify-content-center" style="margin-top: -25px">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body p-2">
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf

                            @method("PUT")


                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" required="">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="email">Username / Email</label>
                                        <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" required>

                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password"  class="form-control" required>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-2 " style="margin-top:35px;">
                                    <div class="position-relative form-group">

                                        <button type="submit" name="save" class="btn btn-sm btn-primary" id="save_btn">
                                            <i class="fa fa-file"></i> Save
                                        </button>

                                        <a href="{{ route('user.index') }}">
                                            <button type="button" name="cancel" class="btn btn-sm btn-danger" id="cancel_btn">
                                            <i class="fa fa-times"></i> Cancel</button>
                                        </a>
                                    </div>
                                </div>

                            </div>


                            <div class="form-row">
                                <div class="col-md-12">

                                    <h4 class="h4">Permission</h4>
                                    <hr/>

                                    <table style="border-collapse: collapse" class="table table-borderless p-4">

                                        <tr>
                                            <td scope="col">Dashborad</td>
                                            <td scope="col"></td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="dashboard_view" id="dashboard_view" style="margin-left: 28%;" @if(in_array(1, $permissions)) checked @endif />

                                                <label for="dashboard_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>


                                        {{-- account --}}
                                            <tr>
                                                <td scope="col">Accounts</td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td> List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="account_view" id="account_view" style="margin-left: 28%;" @if(in_array(2, $permissions)) checked @endif />

                                                    <label for="account_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="account_edit" id="account_edit" style="margin-left: 28%;" @if(in_array(3, $permissions)) checked @endif />

                                                    <label for="account_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="account_delete" id="account_delete" style="margin-left: 28%;" @if(in_array(4, $permissions)) checked @endif />

                                                    <label for="account_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Balance</td>
                                                <td scope="col"></td>


                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="account_balance" id="account_balance" style="margin-left: 28%;" @if(in_array(5, $permissions)) checked @endif />

                                                    <label for="account_balance">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="col"></td>
                                                <td>Ledger</td>
                                                <td scope="col"></td>


                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="account_ledger" id="account_ledger" style="margin-left: 28%;" @if(in_array(6, $permissions)) checked @endif />

                                                    <label for="account_ledger">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                        {{-- account --}}

                                        {{-- fund_transfer --}}
                                            <tr>
                                                <td scope="col">Fund Trasnfer</td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_transfer_list_view" id="fund_transfer_list_view" style="margin-left: 28%;" @if(in_array(7, $permissions)) checked @endif />

                                                    <label for="fund_transfer_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_transfer_edit" id="fund_transfer_edit" style="margin-left: 28%;" @if(in_array(8, $permissions)) checked @endif />

                                                    <label for="fund_transfer_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_transfer_delete" id="fund_transfer_delete" style="margin-left: 28%;" @if(in_array(9, $permissions)) checked @endif />

                                                    <label for="fund_transfer_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="col"></td>
                                                <td>Report</td>
                                                <td scope="col"></td>


                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_transfer_report_view" id="fund_transfer_report_view" style="margin-left: 28%;" @if(in_array(10, $permissions)) checked @endif />

                                                    <label for="fund_transfer_report_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                        {{-- fund_transfer --}}

                                        {{-- expense --}}
                                            <tr>
                                                <td scope="col">Expenses</td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="expense_list_view" id="expense_list_view" style="margin-left: 28%;" @if(in_array(11, $permissions)) checked @endif />

                                                    <label for="expense_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="expense_edit" id="expense_edit" style="margin-left: 28%;" @if(in_array(12, $permissions)) checked @endif />

                                                    <label for="expense_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="expense_delete" id="expense_delete" style="margin-left: 28%;" @if(in_array(13, $permissions)) checked @endif />

                                                    <label for="expense_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Report</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="expense_report_view" id="expense_report_view" style="margin-left: 28%;" @if(in_array(14, $permissions)) checked @endif />

                                                    <label for="expense_report_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Expense Category</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="expense_category_list_view" id="expense_category_list_view" style="margin-left: 28%;" @if(in_array(15, $permissions)) checked @endif />

                                                    <label for="expense_category_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="expense_category_edit" id="expense_category_edit" style="margin-left: 28%;" @if(in_array(16, $permissions)) checked @endif />

                                                    <label for="expense_category_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="expense_category_delete" id="expense_category_delete" style="margin-left: 28%;" @if(in_array(17, $permissions)) checked @endif />

                                                    <label for="expense_category_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                        {{-- expense --}}

                                        {{-- Capital Account--}}
                                            <tr>
                                                <td scope="col">Capital Account</td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="capital_account_list_view" id="capital_account_list_view" style="margin-left: 28%;" @if(in_array(18, $permissions)) checked @endif />

                                                    <label for="capital_account_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="capital_account_edit" id="capital_account_edit" style="margin-left: 28%;" @if(in_array(19, $permissions)) checked @endif />

                                                    <label for="capital_account_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="capital_account_delete" id="capital_account_delete" style="margin-left: 28%;" @if(in_array(20, $permissions)) checked @endif />

                                                    <label for="capital_account_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Ledger</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="capital_account_ledger_view" id="capital_account_ledger_view" style="margin-left: 28%;" @if(in_array(21, $permissions)) checked @endif />

                                                    <label for="capital_account_ledger_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>
                                        {{-- capital account --}}

                                        {{-- fund add --}}
                                            <tr>
                                                <td scope="col">Fund add </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_add_list_view" id="fund_add_list_view" style="margin-left: 28%;" @if(in_array(22, $permissions)) checked @endif />

                                                    <label for="fund_add_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_add_edit" id="fund_add_edit" style="margin-left: 28%;" @if(in_array(23, $permissions)) checked @endif />

                                                    <label for="fund_add_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_add_delete" id="fund_add_delete" style="margin-left: 28%;" @if(in_array(24, $permissions)) checked @endif />

                                                    <label for="fund_add_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Report</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_add_report_view" id="fund_add_report_view" style="margin-left: 28%;" @if(in_array(25, $permissions)) checked @endif />

                                                    <label for="fund_add_report_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>
                                        {{-- fund add --}}

                                         {{-- Fund return--}}
                                            <tr>
                                                <td scope="col">Fund return</td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_return_list_view" id="fund_return_list_view" style="margin-left: 28%;" @if(in_array(26, $permissions)) checked @endif />

                                                    <label for="fund_return_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_return_edit" id="fund_return_edit" style="margin-left: 28%;" @if(in_array(27, $permissions)) checked @endif />

                                                    <label for="fund_return_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_return_delete" id="fund_return_delete" style="margin-left: 28%;" @if(in_array(28, $permissions)) checked @endif />

                                                    <label for="fund_return_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Report</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="fund_return_report_view" id="fund_return_report_view" style="margin-left: 28%;" @if(in_array(29, $permissions)) checked @endif />

                                                    <label for="fund_return_report_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>
                                        {{-- capital account --}}


                                         {{-- Employee --}}
                                            <tr>
                                                <td scope="col">Employee </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_list_view" id="employee_list_view" style="margin-left: 28%;" @if(in_array(30, $permissions)) checked @endif />

                                                    <label for="employee_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_edit" id="employee_edit" style="margin-left: 28%;" @if(in_array(31, $permissions)) checked @endif />

                                                    <label for="employee_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_delete" id="employee_delete" style="margin-left: 28%;" @if(in_array(32, $permissions)) checked @endif />

                                                    <label for="employee_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Payment</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_payment_list_view" id="employee_payment_list_view" style="margin-left: 28%;" @if(in_array(33, $permissions)) checked @endif />

                                                    <label for="employee_payment_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_payment_edit" id="employee_payment_edit" style="margin-left: 28%;" @if(in_array(35, $permissions)) checked @endif />

                                                    <label for="employee_payment_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_payment_delete" id="employee_payment_delete" style="margin-left: 28%;" @if(in_array(36, $permissions)) checked @endif />

                                                    <label for="employee_payment_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>


                                            <tr>
                                                <td scope="col"></td>
                                                <td>Report</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_payment_report" id="employee_payment_report" style="margin-left: 28%;" @if(in_array(36, $permissions)) checked @endif />

                                                    <label for="employee_payment_report">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Ledger</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_ledger_view" id="employee_ledger_view" style="margin-left: 28%;" @if(in_array(37, $permissions)) checked @endif />

                                                    <label for="employee_ledger_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>
                                        {{--amployee --}}


                                         {{-- Employee monthly salary --}}
                                            <tr>
                                                <td scope="col">Employee monthly salary </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Generate</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_monthly_generate_view" id="employee_monthly_generate_view" style="margin-left: 28%;" @if(in_array(38, $permissions)) checked @endif />

                                                    <label for="employee_monthly_generate_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_monthly_list" id="employee_monthly_list" style="margin-left: 28%;" @if(in_array(39, $permissions)) checked @endif />

                                                    <label for="employee_monthly_list">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>

                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_monthly_delete" id="employee_monthly_delete" style="margin-left: 28%;" @if(in_array(41, $permissions)) checked @endif />

                                                    <label for="employee_monthly_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                        {{-- monthly salary  --}}

                                        {{-- Employee daily salary --}}
                                            <tr>
                                                <td scope="col">Employee daily salary </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_daily_list" id="employee_daily_list" style="margin-left: 28%;" @if(in_array(43, $permissions)) checked @endif />

                                                    <label for="employee_daily_list">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_daily_edit" id="employee_daily_edit" style="margin-left: 28%;" @if(in_array(44, $permissions)) checked @endif />

                                                    <label for="employee_daily_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_daily_delete" id="employee_daily_delete" style="margin-left: 28%;" @if(in_array(45, $permissions)) checked @endif />

                                                    <label for="employee_daily_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Report</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="employee_daily_report_view" id="employee_daily_report_view" style="margin-left: 28%;" @if(in_array(46, $permissions)) checked @endif />

                                                    <label for="employee_daily_report_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>
                                        {{-- daily salary --}}


                                        {{-- Party --}}
                                            <tr>
                                                <td scope="col">Party </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_list" id="party_list" style="margin-left: 28%;" @if(in_array(47, $permissions)) checked @endif />

                                                    <label for="party_list">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_edit" id="party_edit" style="margin-left: 28%;" @if(in_array(48, $permissions)) checked @endif />

                                                    <label for="party_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_delete" id="party_delete" style="margin-left: 28%;" @if(in_array(49, $permissions)) checked @endif />

                                                    <label for="party_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Payment</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_payment_list" id="party_payment_list" style="margin-left: 28%;" @if(in_array(50, $permissions)) checked @endif />

                                                    <label for="party_payment_list">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_payment_edit" id="party_payment_edit" style="margin-left: 28%;" @if(in_array(51, $permissions)) checked @endif />

                                                    <label for="party_payment_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_payment_delete" id="party_payment_delete" style="margin-left: 28%;" @if(in_array(52, $permissions)) checked @endif />

                                                    <label for="party_payment_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Ledger</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_ledger_view" id="party_ledger_view" style="margin-left: 28%;" @if(in_array(53, $permissions)) checked @endif />

                                                    <label for="party_ledger_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>
                                         {{-- Party --}}

                                        {{-- Party purchase --}}
                                            <tr>
                                                <td scope="col">Party purchase </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>New purchase</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_purchase_new_view" id="party_purchase_new_view" style="margin-left: 28%;" @if(in_array(54, $permissions)) checked @endif />

                                                    <label for="party_purchase_new_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>List</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_purchase_list_view" id="party_purchase_list_view" style="margin-left: 28%;" @if(in_array(55, $permissions)) checked @endif />

                                                    <label for="party_purchase_list_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_purchase_edit" id="party_purchase_edit" style="margin-left: 28%;" @if(in_array(56, $permissions)) checked @endif />

                                                    <label for="party_purchase_edit">Edit</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_purchase_delete" id="party_purchase_delete" style="margin-left: 28%;" @if(in_array(57, $permissions)) checked @endif />

                                                    <label for="party_purchase_delete">Delete</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>
                                            </tr>

                                            <tr>
                                                <td scope="col"></td>
                                                <td>Report</td>
                                                <td scope="col"></td>
                                                <td scope="col">
                                                    <input type="checkbox" name="permission[]" value="party_purchase_report_view" id="party_purchase_report_view" style="margin-left: 28%;" @if(in_array(58, $permissions)) checked @endif />

                                                    <label for="party_purchase_report_view">View</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                </td>


                                            </tr>
                                        {{-- Party --}}


                                    {{-- Rent --}}
                                        <tr>
                                            <td scope="col">Rent </td>
                                            <td scope="col"> </td>
                                            <td scope="col"> </td>

                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="rent_view" id="rent_view" style="margin-left: 28%;" @if(in_array(59, $permissions)) checked @endif />

                                                <label for="rent_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="rent_edit" id="rent_edit" style="margin-left: 28%;" @if(in_array(60, $permissions)) checked @endif />

                                                <label for="rent_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="rent_delete" id="rent_delete" style="margin-left: 28%;" @if(in_array(61, $permissions)) checked @endif />

                                                <label for="rent_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                    {{-- Rent --}}

                                    {{-- Bill --}}
                                        <tr>
                                            <td scope="col">Bill </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Generate</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_generate_view" id="bill_generate_view" style="margin-left: 28%;" @if(in_array(62, $permissions)) checked @endif />

                                                <label for="bill_generate_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>


                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>List</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_view" id="bill_view" style="margin-left: 28%;" @if(in_array(63, $permissions)) checked @endif />

                                                <label for="bill_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_print" id="bill_print" style="margin-left: 28%;" @if(in_array(64, $permissions)) checked @endif />

                                                <label for="bill_print">Print</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_delete" id="bill_delete" style="margin-left: 28%;" @if(in_array(65, $permissions)) checked @endif />

                                                <label for="bill_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Print</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_print" id="bill_print" style="margin-left: 28%;" @if(in_array(66, $permissions)) checked @endif />

                                                <label for="bill_print">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>


                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Category</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_category_list_view" id="bill_category_list_view" style="margin-left: 28%;" @if(in_array(67, $permissions)) checked @endif />

                                                <label for="bill_category_list_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_category_edit" id="bill_category_edit" style="margin-left: 28%;" @if(in_array(68, $permissions)) checked @endif />

                                                <label for="bill_category_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_category_delete" id="bill_category_delete" style="margin-left: 28%;" @if(in_array(69, $permissions)) checked @endif />

                                                <label for="bill_category_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Payment</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_payment_list_view" id="bill_payment_list_view" style="margin-left: 28%;" @if(in_array(69, $permissions)) checked @endif />

                                                <label for="bill_payment_list_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_payment_edit" id="bill_payment_edit" style="margin-left: 28%;" @if(in_array(70, $permissions)) checked @endif />

                                                <label for="bill_payment_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_payment_delete" id="bill_payment_delete" style="margin-left: 28%;" @if(in_array(71, $permissions)) checked @endif />

                                                <label for="bill_payment_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Ledger</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_ledger_view" id="bill_ledger_view" style="margin-left: 28%;" @if(in_array(72, $permissions)) checked @endif />

                                                <label for="bill_ledger_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>


                                        </tr>
                                    {{-- bill --}}

                                    {{-- house --}}
                                        <tr>
                                            <td scope="col">House </td>
                                            <td scope="col"> </td>
                                            <td scope="col"> </td>

                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="house_view" id="house_view" style="margin-left: 28%;" @if(in_array(73, $permissions)) checked @endif />

                                                <label for="house_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="house_edit" id="house_edit" style="margin-left: 28%;" @if(in_array(74, $permissions)) checked @endif />

                                                <label for="house_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="house_delete" id="house_delete" style="margin-left: 28%;" @if(in_array(75, $permissions)) checked @endif />

                                                <label for="house_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                    {{-- house --}}

                                    {{-- floor --}}
                                        <tr>
                                            <td scope="col">Floor </td>
                                            <td scope="col"> </td>
                                            <td scope="col"> </td>

                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="floor_view" id="floor_view" style="margin-left: 28%;" @if(in_array(76, $permissions)) checked @endif />

                                                <label for="floor_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="floor_edit" id="floor_edit" style="margin-left: 28%;" @if(in_array(77, $permissions)) checked @endif />

                                                <label for="floor_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="floor_delete" id="floor_delete" style="margin-left: 28%;" @if(in_array(78, $permissions)) checked @endif />

                                                <label for="floor_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                    {{-- floor --}}

                                    {{-- flat --}}
                                    <tr>
                                        <td scope="col">Flats </td>
                                        <td scope="col"> </td>
                                        <td scope="col"> </td>

                                        <td scope="col">
                                            <input type="checkbox" name="permission[]" value="flat_view" id="flat_view" style="margin-left: 28%;" @if(in_array(79, $permissions)) checked @endif />

                                            <label for="flat_view">View</label>
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td scope="col">
                                            <input type="checkbox" name="permission[]" value="flat_edit" id="flat_edit" style="margin-left: 28%;" @if(in_array(80, $permissions)) checked @endif />

                                            <label for="flat_edit">Edit</label>
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td scope="col">
                                            <input type="checkbox" name="permission[]" value="flat_delete" id="flat_delete" style="margin-left: 28%;" @if(in_array(81, $permissions)) checked @endif />

                                            <label for="flat_delete">Delete</label>
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                    </tr>
                                    {{-- flat --}}


                                    {{-- User --}}
                                        <tr>
                                            <td scope="col">User </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>New</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="user_view" id="user_view" style="margin-left: 28%;" @if(in_array(82, $permissions)) checked @endif />

                                                <label for="user_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>


                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>List</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="user_view" id="user_view" style="margin-left: 28%;" @if(in_array(82, $permissions)) checked @endif />

                                                <label for="user_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="user_edit" id="user_edit" style="margin-left: 28%;" @if(in_array(83, $permissions)) checked @endif />

                                                <label for="user_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="user_delete" id="user_delete" style="margin-left: 28%;" @if(in_array(84, $permissions)) checked @endif />

                                                <label for="user_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                    {{--User --}}


                                </table>
                            </div>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




