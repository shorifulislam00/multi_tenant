<?php

namespace App\Http\Controllers;

use App\Models\ElectricMeterReading;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Transaction;
use App\Models\FlatRent;
use App\Models\Account;
use App\Models\AccountLedger;
use App\Models\TenantLedger;
use App\Models\Flat;
use App\Models\Bill;
use App\Models\RentBillConfig;
use App\Models\FlatRentDetail;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class FlatRentBillController extends Controller
{
    public $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $months = $this->months;
        $user_id = Auth::user()->id;
        $houses = House::where('created_by', $user_id)->get();

        return view('admin.electric-bill-generate.index', compact('houses', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $year = request('year_id');
        $month = request('month_id');

        $data = FlatRent::with(['flat', 'electric_meter_reading' => function ($q) {
            $q->where("month_id", request('month_id'))
                ->where("year_id", request('year_id'));
        }])
            ->where('house_id', request('house_id'))
            ->where('status', 'running')
            ->get();

        // dd($data);

        $house = House::find($request->house_id);

        return view('admin.electric-bill-generate.create', compact('data', 'house', 'year', 'month'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            // dd($request->all());

            // if anything exist with this year and month
            $existing = Bill::where('month_id', $request->month_id)
                ->where('year_id', $request->year_id)

                ->get();

            // dd($existing->pluck("id"));

            if ($existing->isNotEmpty()) {
                FlatRentDetail::whereIn("bill_id", $existing->pluck("id"))->delete();
                Bill::whereIn("id", $existing->pluck("id"))->delete();

                $existMonth = $request->month_id == 12 ? 1 : $request->month_id + 1;
                $existYear = $request->month_id == 12 ? $request->year_id + 1 : $request->year_id;

                // next month data delete
                ElectricMeterReading::where([
                    "month_id" => $existMonth,
                    "year_id" => $existYear,
                    "house_id" => $request->house_id
                ])->delete();

                // running month data update
                ElectricMeterReading::where([
                    "month_id" => $request->month_id,
                    "year_id" => $request->year_id
                ])->update([
                    "present_meter_reading" => null,
                    "rate" => null,
                    "amount" => null
                ]);
            }

            foreach ($request->meter_pid as $key => $pid) {

                $electricMeterReading = ElectricMeterReading::find($pid);

                $electricMeterReading->house_id = $request->house_id;
                $electricMeterReading->month_id = $request->month_id;
                $electricMeterReading->year_id = $request->year_id;
                $electricMeterReading->present_meter_reading = $request->present_reading[$key];
                $electricMeterReading->flat_rent_id = $request->flatrent_id[$key];
                $electricMeterReading->rate = $request->rate[$key];
                $electricMeterReading->amount = $request->amount[$key];


                $electricMeterReading->update();

                //__create new data__ //
                $nextMonth = $request->month_id + 1;
                $nextYear = $request->year_id;

                // Check if the next month  12 (December)
                if ($nextMonth > 12) {
                    $nextMonth = 1; // Reset month to January
                    $nextYear++;    // Increment the year
                }

                $insertData = new ElectricMeterReading();

                $insertData->house_id = $request->house_id;
                $insertData->month_id = $nextMonth;
                $insertData->year_id = $nextYear;
                $insertData->previous_meter_reading = $request->present_reading[$key];
                $insertData->flat_rent_id = $request->flatrent_id[$key];
                $insertData->rate = $request->rate[$key];

                $insertData->save();

                // meter_amount
                $meter_amount = floatval($electricMeterReading->amount);

                // Rent bill config
                $rent_bill_configs = RentBillConfig::with(['billConfig'])->where('flat_rent_id', $request->flatrent_id[$key])->get();

                // dd($rent_bill_configs);


                // Sum of rent bill config amounts
                $total_bill_config_amount = floatval($rent_bill_configs->sum("amount"));


                // // Calculate the sum
                $total_sum = $meter_amount + $total_bill_config_amount;


                $tenant_ledger = new TenantLedger();

                $tenant_ledger->action_date = now();
                $tenant_ledger->flat_rent_id = $request->flatrent_id[$key];
                $tenant_ledger->year_id = $request->year_id;
                $tenant_ledger->month_id = $request->month_id;
                $tenant_ledger->dr =  $total_sum;
                $tenant_ledger->comment =  "Rent bill";
                $tenant_ledger->save();

                $tenant_ledger->account_ledger()->create([
                    "action_date" =>  now(),
                    "type" => "rent",
                    "reff_id" => $tenant_ledger->id,
                    "dr" =>  $total_sum,
                    "comment" => "Rent bill"
                ]);


                $bill = new Bill();
                $bill->flat_rent_id = $request->flatrent_id[$key];
                $bill->year_id = $request->year_id;
                $bill->action_date = now();
                $bill->month_id = $request->month_id;
                $bill->amount =  $total_sum;
                $bill->save();


                // rent bill config
                foreach ($rent_bill_configs as $item) {

                    $flatRentBill = new FlatRentDetail();
                    $flatRentBill->rent_bill_config_id = $item->id;
                    $flatRentBill->bill_id = $bill->id;
                    $flatRentBill->amount =  $item->billConfig->type == 2 ? $meter_amount : $item->amount;
                    $flatRentBill->save();
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Bill generate successfully',
                'redirect_url' => route('bill.list')
            ]);
        } catch (\Exception $e) {

            dd($e);
            return response()->json(['message' => 'error occurred']);
        }
    }

    public function list(Request $request)
    {


        if ($request->ajax()) {

            $data = Bill::with('flatRent')

                ->when(request('month_id') > 0, function ($q) {
                    $q->where("bills.month_id", request('month_id'));
                })
                ->when(request('year_id') > 0, function ($q) {
                    $q->where("bills.year_id", request('year_id'));
                })
                ->when(request('is_paid') !== null, function ($q) {
                    $q->where("bills.is_paid", request('is_paid'));
                })
                ->when(request('house_id') > 0, function ($q) {
                    $q->where('flat_rents.house_id', request('house_id'));
                })
                ->when(request('flat_id'), function ($q) {
                    $q->where('flat_rents.flat_id', request('flat_id'));
                })

                ->get();

            // dd($data);


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('house_name', function ($row) {
                    return $row->flatRent ? $row->flatRent->house->name : '';
                })
                ->addColumn('flat_name', function ($row) {
                    return $row->flatRent ? $row->flatRent->flat->flat_number : '';
                })
                ->addColumn('mobile_no', function ($row) {
                    return $row->flatRent ? $row->flatRent->mobile_no : '';
                })
                ->addColumn('tenant_name', function ($row) {
                    return $row->flatRent ? $row->flatRent->tenant_name : '';
                    // return $row->flatRent->tenant_name;

                })
                ->addColumn('amount', function ($row) {
                    return number_format($row->amount, 0, '.', ',');
                })
                ->addColumn("action", function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-transition btn-outline-primary btn-sm billPayment"> <i class="fas fa-file"></i> Payment</a>';

                    $btn .= '<a href="' . route('bill.single.print', ['id' => $row->id]) . '" class="btn btn-transition btn-outline-info btn-sm" target="_blank"> <i class="fas fa-solid fa-print" ></i> Print</a>';

                    $btn .= ' <button class="btn btn-transition btn-outline-danger btn-sm deleteBill" data-id="' . $row->id . '"><i class="fas fa-solid fa-trash" ></i>Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user_id = Auth::user()->id;

        $months = $this->months;
        $houses = House::where('created_by', $user_id)->get();
        $flats = Flat::all();
        $accounts = Account::all();

        return view('admin.electric-bill-generate.list', compact('months', 'houses', 'flats', 'accounts'));
    }

    public function getFlatsByHouse(Request $request)
    {
        $houseId = $request->input('house_id');
        $flats = Flat::where('house_id', $houseId)->get();
        return response()->json(['flats' => $flats]);
    }

    public function printBill()
    {
        $months = $this->months;
        $user_id = Auth::user()->id;

        $houses = House::where('created_by', $user_id)->get();

        return view('admin.electric-bill-generate.bill-print', compact('months', 'houses'));
    }

    public function reportPrintBill(Request $request)
    {

        $year = request('year_id');
        $month = request('month_id');
        $data = Bill::with(['flatRent' => function ($q) {
            $q->where('house_id', request('house_id'));
        }])
            ->where("month_id", request('month_id'))
            ->where("year_id", request('year_id'))
            ->get();

        return view('admin.electric-bill-generate.report-print-bill', compact('data'));
    }

    public function single_print($id)
    {
        // Retrieve data by ID
        $data = Bill::with('flatRent')->where('id', $id)->get();

        // dd($data);
        // Pass data to the blade view
        return view('admin.electric-bill-generate.report-print-bill', compact('data'));
    }


    public function bill_payment($id)
    {

        $data = Bill::find($id);
        // dd($data);
        $data->amount = number_format($data->amount, 2, '.', ',');

        return response()->json($data);
    }

    public function update_bill_payment(Request $request, $id)
    {

        // dd($request->all());
        try {

            $bill = Bill::find($id);

            // update transaction table

            $bill->is_paid = 1;
            $bill->action_date = now();
            $bill->save();


            // data insert into transaction payment table
            $tenant_ledger = TenantLedger::create([
                'flat_rent_id' => $bill->flat_rent_id,
                'account_id' => $request->account_id,
                "action_date" => date("Y-m-d", strtotime($request->payment_date)),
                'cr' => $bill->amount,
                'month_id' => $bill->month_id,
                'year_id' => $bill->year_id,
                'comment' => $request->comment,

            ]);

            $account_ledger =  AccountLedger::create([
                "type" => "payment",
                "account_id" => $request->account_id,
                "reff_id" => $tenant_ledger->id,
                "action_date" => date("Y-m-d", strtotime($request->payment_date)),
                "comment" => $request->comment,
                'cr' => $bill->amount,
            ]);

            //update account balance

            $account = Account::findOrFail($request->account_id);
            $account->balance += $bill->amount;
            $account->save();
            // dd($account);



            return response()->json(['status' => 'success', 'message' => 'Payment updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error',  'message' => 'Error updated payment.']);
        }
    }










    /**
     * Display the specified resource.
     */
    public function show(ElectricMeterReading $electricMeterReading)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectricMeterReading $electricMeterReading)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ElectricMeterReading $electricMeterReading)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Bill::find($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Bill deleted successfully.']);
    }
}
