<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\AccountLedger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $user_id = Auth::user()->id;

            $data = Account::where('created_by', $user_id)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('balance', function ($row) {
                    return number_format($row->opening_balance, 0, '.', ',');
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn-transition btn btn-outline-primary btn-sm editAccount"> <i class="fas fa-edit"></i> Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn-transition btn btn-outline-danger  btn-sm deleteAccount"><i class="fas fa-trash"></i> Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'account_name' => 'required',
                'acc_number' => 'required',

            ]
        );

        DB::beginTransaction();

        try {

            $user_id = Auth::user()->id;

            $account = Account::create(
                [
                    'created_by' => $user_id,
                    'name' => $request->account_name,
                    'acc_number' => $request->acc_number,
                    'branch_name' => $request->branch_name,
                    'opening_balance' => $request->opening_balance,
                    'balance' => $request->opening_balance,
                ]
            );


            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Account created successfully.']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => 'Fail to create account.']);

            //dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $account = Account::find($id);
        return response()->json($account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function update(Request $request, $id)
    {
        // dd($request->all());


        try {
            $user_id = Auth::user()->id;

            $account = Account::find($id);
            $account->created_by = $user_id;
            $account->name = $request->account_name;
            $account->acc_number = $request->acc_number;
            $account->branch_name = $request->branch_name;
            $account->opening_balance = $request->opening_balance;
            $account->balance = $request->opening_balance;
            $account->save();



            return response()->json(['status' => 'success', 'message' => 'Account updated successfully.']);
        } catch (\Exception $e) {


            return response()->json(['status' => 'error', 'message' => 'Fail to create account.']);

            //dd($e);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Account::find($id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Account deleted successfully.']);
    }

    /**
     * balance
     *
     * @return void
     */
    public function balance()
    {
        $data = Account::all();

        return view("admin.accounts.balance_report", compact('data'));
    }

    public function ledger()
    {
        $accounts = Account::all();

        return view("admin.accounts.ledger", compact('accounts'));
    }

    public function print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        // dd($request->account_id, $from_date, $to_date);

        $data =  AccountLedger::when(request('account_id') > 0, function ($q) {
            $q->where("account_id", request('account_id'));
        })
            ->when((!empty($request->from_date) || !empty($request->to_date)), function ($q) use ($request) {
                if (!empty($request->from_date) && empty($request->to_date)) {  // only from date
                    $q->whereDate("action_date", ">=", date("Y-m-d", strtotime($request->from_date)));
                } else if (empty($request->from_date) && !empty($request->to_date)) {  // only to date
                    $q->whereDate("action_date", "<=", date("Y-m-d", strtotime($request->to_date)));
                } else if (!empty($request->from_date) && !empty($request->to_date)) {  // both dates
                    $q->whereBetween("action_date", [
                        date("Y-m-d", strtotime($request->from_date)),
                        date("Y-m-d", strtotime($request->to_date))
                    ]);
                }
            })
            ->orderBy('action_date')
            ->get();
        // dd($data);




        $account = Account::find($request->account_id);

        // previous due / advance
        $previous_balance = 0;
        if (!empty($request->from_date)) {
            $previous_data = AccountLedger::where("account_id", $request->account_id)
                ->whereDate("action_date", "<", date("Y-m-d", strtotime(request('from_date'))));


            $previous_balance = $previous_data->sum("dr") - $previous_data->sum("cr");
        }


        $report_title = "Account ledger";
        return view("admin.accounts.ledger-print", compact('data', 'account', 'previous_balance', 'report_title',));
    }
}
