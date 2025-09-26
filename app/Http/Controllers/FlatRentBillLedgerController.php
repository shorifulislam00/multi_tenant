<?php

namespace App\Http\Controllers;

use App\Models\FlatRent;
use App\Models\TenantLedger;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class FlatRentBillLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // dd($data);
        if ($request->ajax()) {

            $data = TenantLedger::with(['flat_rent', 'account'])
                ->when($request->flat_rent_id > 0, function ($q) {
                    $q->where("flat_rent_id", request('flat_rent_id'));
                })
                ->when((!empty($request->from_date) || !empty($request->to_date)), function ($q) {
                    if (!empty(request('from_date')) && empty(request('to_date'))) {  // only from date
                        $q->whereDate("action_date", ">=", date("Y-m-d", strtotime(request('from_date'))));
                    } else if (empty(request('from_date')) && !empty(request('to_date'))) {  // only to date
                        $q->whereDate("action_date", "<=", date("Y-m-d", strtotime(request('to_date'))));
                    } else if (!empty(request('from_date')) && !empty(request('to_date'))) {  // both date
                        $q->whereBetween("action_date", [date("Y-m-d", strtotime(request('from_date'))), date("Y-m-d", strtotime(request('to_date')))]);
                    }
                    // for search end
                })
                ->whereNull('dr')
                ->get();
            //  dd($data->transaction_payment->account_id);

            return DataTables::of($data)

                ->addIndexColumn()
                ->addColumn('account', function ($row) {
                    return $row->account->name;
                })
                ->addColumn('cr', function ($row) {
                    return number_format($row->cr, 0, '.', ',');
                })

                ->addColumn('flat_number', function ($row) {
                    return $row->flat_rent->flat->flat_number;
                })
                ->addColumn('action', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-transition btn-outline-danger btn-sm deleteBillPayment"><i class="fas fa-trash"></i> Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        $user_id = Auth::user()->id;
        $flatrents = FlatRent::with('flat')->where('created_by', $user_id)->get();
        return view('admin.electric-bill-generate.payment-list', compact('flatrents'));
    }

    public function ledger()
    {
        $flat_rents = FlatRent::all();

        return view("admin.electric-bill-generate.ledger", compact('flat_rents'));
    }

    public function print(Request $request)
    {
        // $from_date = $request->from_date;
        // $to_date = $request->to_date;

        // dd($from_date, $to_date);

        $data = TenantLedger::with('flat_rent')
            ->when(request('flat_rent_id') > 0, function ($q) {
                $q->where("flat_rent_id", request('flat_rent_id'));
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
            ->orderBy("action_date")
            ->get();

        // dd($data);


        $flat_rent = [];
        if ($request->flat_rent_id) {
            $flat_rent = FlatRent::find($request->flat_rent_id);
        }

        // previous due / advance
        $previous_balance = 0;
        if (!empty($request->from_date)) {
            $previous_data = TenantLedger::where("flat_rent_id", $request->flat_rent_id)
                ->whereDate("action_date", "<", date("Y-m-d", strtotime(request('from_date'))));


            $previous_balance = $previous_data->sum("dr") - $previous_data->sum("cr");
        }
        // always add opening balance
        // $previous_balance += $flat_rent ? $flat_rent->advance_amount : 0 ;
        // dd($previous_balance);


        return view("admin.electric-bill-generate.ledger-print", compact('data', 'flat_rent', 'previous_balance'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $ledger = TenantLedger::findOrFail($id);
            // dd($bill_payment->transaction_payment->account->balance);

            // Restore the previous balances
            $account = $ledger->account;
            $account->balance -= $ledger->cr;
            $account->save();



            $ledger->delete();

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Payment deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Fail to delete.']);
        }
    }
}
