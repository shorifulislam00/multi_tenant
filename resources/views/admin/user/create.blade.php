@extends('admin.layouts.app')

@section('title', 'User list')

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
                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf

                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror" required="">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="email">Username / Email</label>
                                        <input type="text" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror" required>

                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
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
                                            <button type="button" name="cancel" class="btn btn-sm btn-danger"
                                                id="cancel_btn">
                                                <i class="fa fa-times"></i> Cancel</button>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col-md-12">

                                    <h4 class="h4">Permission</h4>
                                    <hr />

                                    <table style="border-collapse: collapse" class="table table-borderless p-4">

                                        <tr>
                                            <td scope="col">Dashborad</td>
                                            <td scope="col"></td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="dashboard_view"
                                                    id="dashboard_view" style="margin-left: 28%;" />

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
                                                <input type="checkbox" name="permission[]" value="account_view"
                                                    id="account_view" style="margin-left: 28%;" />

                                                <label for="account_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="account_edit"
                                                    id="account_edit" style="margin-left: 28%;" />

                                                <label for="account_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="account_delete"
                                                    id="account_delete" style="margin-left: 28%;" />

                                                <label for="account_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Balance</td>
                                            <td scope="col"></td>


                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="account_balance"
                                                    id="account_balance" style="margin-left: 28%;" />

                                                <label for="account_balance">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="col"></td>
                                            <td>Ledger</td>
                                            <td scope="col"></td>


                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="account_ledger"
                                                    id="account_ledger" style="margin-left: 28%;" />

                                                <label for="account_ledger">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                        {{-- account --}}


                                        {{-- Rent --}}
                                        <tr>
                                            <td scope="col">Rent </td>
                                            <td scope="col"> </td>
                                            <td scope="col"> </td>

                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="rent_view"
                                                    id="rent_view" style="margin-left: 28%;" />

                                                <label for="rent_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="rent_edit"
                                                    id="rent_edit" style="margin-left: 28%;" />

                                                <label for="rent_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="rent_delete"
                                                    id="rent_delete" style="margin-left: 28%;" />

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
                                                <input type="checkbox" name="permission[]" value="party_report_view"
                                                    id="party_report_view" style="margin-left: 28%;" />

                                                <label for="party_report_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>


                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>List</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_view"
                                                    id="bill_view" style="margin-left: 28%;" />

                                                <label for="bill_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_print"
                                                    id="bill_print" style="margin-left: 28%;" />

                                                <label for="bill_print">Print</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_delete"
                                                    id="bill_delete" style="margin-left: 28%;" />

                                                <label for="bill_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Print</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_print"
                                                    id="bill_print" style="margin-left: 28%;" />

                                                <label for="bill_print">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>


                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Category</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]"
                                                    value="bill_category_list_view" id="bill_category_list_view"
                                                    style="margin-left: 28%;" />

                                                <label for="bill_category_list_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_category_edit"
                                                    id="bill_category_edit" style="margin-left: 28%;" />

                                                <label for="bill_category_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_category_delete"
                                                    id="bill_category_delete" style="margin-left: 28%;" />

                                                <label for="bill_category_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Payment</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_payment_list_view"
                                                    id="bill_payment_list_view" style="margin-left: 28%;" />

                                                <label for="bill_payment_list_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_payment_edit"
                                                    id="bill_payment_edit" style="margin-left: 28%;" />

                                                <label for="bill_payment_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_payment_delete"
                                                    id="bill_payment_delete" style="margin-left: 28%;" />

                                                <label for="bill_payment_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>Ledger</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="bill_ledger_view"
                                                    id="bill_ledger_view" style="margin-left: 28%;" />

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
                                                <input type="checkbox" name="permission[]" value="house_view"
                                                    id="house_view" style="margin-left: 28%;" />

                                                <label for="house_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="house_edit"
                                                    id="house_edit" style="margin-left: 28%;" />

                                                <label for="house_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="house_delete"
                                                    id="house_delete" style="margin-left: 28%;" />

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
                                                <input type="checkbox" name="permission[]" value="floor_view"
                                                    id="floor_view" style="margin-left: 28%;" />

                                                <label for="floor_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="floor_edit"
                                                    id="floor_edit" style="margin-left: 28%;" />

                                                <label for="floor_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="floor_delete"
                                                    id="floor_delete" style="margin-left: 28%;" />

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
                                                <input type="checkbox" name="permission[]" value="flat_view"
                                                    id="flat_view" style="margin-left: 28%;" />

                                                <label for="flat_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="flat_edit"
                                                    id="flat_edit" style="margin-left: 28%;" />

                                                <label for="flat_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="flat_delete"
                                                    id="flat_delete" style="margin-left: 28%;" />

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
                                                <input type="checkbox" name="permission[]" value="user_view"
                                                    id="user_view" style="margin-left: 28%;" />

                                                <label for="user_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>


                                        </tr>

                                        <tr>
                                            <td scope="col"></td>
                                            <td>List</td>
                                            <td scope="col"></td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="user_view"
                                                    id="user_view" style="margin-left: 28%;" />

                                                <label for="user_view">View</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="user_edit"
                                                    id="user_edit" style="margin-left: 28%;" />

                                                <label for="user_edit">Edit</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td scope="col">
                                                <input type="checkbox" name="permission[]" value="user_delete"
                                                    id="user_delete" style="margin-left: 28%;" />

                                                <label for="user_delete">Delete</label>
                                                &nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>

                                        {{-- User --}}


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
