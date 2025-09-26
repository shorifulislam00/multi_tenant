<?php

namespace App\Http\Controllers;

use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\Flat;
use App\Models\Floor;
use App\Models\Account;
use App\Models\House;
use App\Models\FlatRent;
use App\Models\BillConfig;
use Illuminate\Http\Request;
use App\Models\AccountLedger;
use Illuminate\Support\Facades\Auth;

class FlatRentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // dd($data);
        $user_id = Auth::user()->id;
        if ($request->ajax()) {


            $data = FlatRent::with(['house', 'floor', 'flat'])
                ->when($request->house_id > 0, function ($q) {
                    $q->where("house_id", request('house_id'));
                })
                ->when($request->floor_id > 0, function ($q) {
                    $q->where("floor_id", request('floor_id'));
                })
                ->when($request->flat_id > 0, function ($q) {
                    $q->where("flat_id", request('flat_id'));
                })
                ->where('created_by', $user_id)
                ->get();
            // dd($data);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('house', function ($row) {
                    return $row->house->name;
                })
                ->addColumn('floor', function ($row) {
                    return $row->floor->name;
                })
                ->addColumn('flat_number', function ($row) {
                    return $row->flat->flat_number;
                })
                ->addColumn('advance_amount', function ($row) {
                    return number_format($row->advance_amount, 0, '.', ',');
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn-transition btn btn-outline-primary btn-sm editFlatRent"> <i class="fas fa-edit"></i>Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn-transition btn btn-outline-danger btn-sm deleteFlatRent"><i class="fas fa-trash"></i>Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $houses = House::where('created_by', $user_id)->get();
        $floors = Floor::where('created_by', $user_id)->get();

        $flats = Flat::where('created_by', $user_id)->get();
        $billconfigs = BillConfig::latest()->where('type', 0)->get();
        $accounts = Account::where('created_by', $user_id)->get();

        return view('admin.flat-rent.index', compact('houses', 'floors', 'flats', 'billconfigs', 'accounts'));
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

        // dd($request->all());
        DB::beginTransaction();


        $request->validate(
            [
                'select_house_id' => 'required',
                'select_floor_id' => 'required',
                'select_flat_id' => 'required',
                'rent_date' => 'required',
                'advance' => 'required|numeric',
                'account_id' => 'required',
                'meter_reading' => 'required',
            ],
        );


        try {
            $existingFlatRent = FlatRent::where('house_id', $request->select_house_id)
                ->where('floor_id', $request->select_floor_id)
                ->where('flat_id', $request->select_flat_id)
                ->where('status', 'running')
                ->first();

            if ($existingFlatRent) {
                return response()->json(['status' => 'error', 'message' => 'Flat is already running and booked.']);
            }

            $user_id = Auth::user()->id;

            //  __insert flat rent data__ //
            $flatrent =  FlatRent::create(

                [
                    'created_by' => $user_id,
                    'house_id' => $request->select_house_id,
                    'floor_id' => $request->select_floor_id,
                    'flat_id' => $request->select_flat_id,
                    "rent_date" => date("Y-m-d", strtotime($request->rent_date)),
                    'tenant_name' => $request->tenant_name,
                    'mobile_no' => $request->mobile_no,
                    'email' => $request->email,
                    'rent_amount' => $request->rent_amount,
                    'meter_reading' => $request->meter_reading,
                    'address' => $request->address,
                    'advance_amount' => $request->advance,
                ]
            );

            // insert electric meter reading
            $houseInfo = House::find($request->select_house_id);
            $flatInfo = Flat::find($request->select_flat_id);

            $rent_date = new Carbon($request->rent_date);

            $flatrent->electric_meter_reading()->create([
                "house_id" => $request->select_house_id,
                "year_id"   => $rent_date->year,
                "month_id" => $rent_date->month,
                "previous_meter_reading" => $request->meter_reading,
                "rate" => $flatInfo->type == "shop" ? $houseInfo->business_electric_bill : $houseInfo->domestic_electric_bill
            ]);


            $tenant_ledger = $flatrent->tenant_ledger()->create([
                "action_date" => date("Y-m-d", strtotime($request->rent_date)),
                "flat_rent_id" => $flatrent->id,
                "account_id" => $request->account_id,
                "year_id" => $rent_date->year,
                "month_id" => $rent_date->month,
                "cr" =>  $request->advance,
                "comment" => "Rent Advance"

            ]);

            $tenant_ledger->account_ledger()->create([
                "action_date" => date("Y-m-d", strtotime($request->rent_date)),
                "type" => "rent_advance",
                "account_id" => $request->account_id,
                "reff_id" => $tenant_ledger->id,
                "cr" =>  $request->advance,
                "comment" => "Rent Advance"
            ]);

            $account = Account::find($request->account_id);
            $account->balance += $request->advance;
            $account->save();

            // __insert into flat rent bill__ //
            $billconfigs = $request->input('billconfig');
            $amounts = $request->input('amount');

            // dd();

            if (!empty($billconfigs)) {
                $amounts = array_values(array_filter($amounts));

                // bill config
                $billConfig = [];

                // user config
                foreach ($billconfigs as $key => $value) {
                    // dd($value);
                    $billConfig[] = [
                        'bill_config_id' => $value,
                        'amount' => $amounts[$key],
                    ];
                }

                // dd($billConfig);

                // system config
                // 1 = rent amount
                // 2 = electric bill
                $systemConfig = BillConfig::whereIn("type", [1, 2])->get();

                //dd($systemConfig);
                foreach ($systemConfig as $item) {
                    $billConfig[] = [
                        'bill_config_id' => $item->id,
                        'amount' => $item->type == 1 ? $request->rent_amount : 0
                    ];
                }

                $flatrent->rentBillConfigs()->createMany($billConfig);
            }

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Flat rent created successfully.']);
        } catch (\Exception $e) {

            DB::rollback();

            // dd($e);

            return response()->json(['status' => 'error',  'message' => 'Error saving flat rent.']);
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
        $flatrent = FlatRent::with('rentBillConfigs', 'tenant_ledger')->find($id);
        $floors = Floor::where('house_id', $flatrent->house_id)->get();
        $flats = Flat::where('floor_id', $flatrent->floor_id)->get();



        $data = [
            'flat_rents' => $flatrent,
            'floors' => $floors,
            'flats' => $flats
        ];

        // dd($data);

        return response()->json($data);
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
        DB::beginTransaction();

        $request->validate(
            [
                'select_house_id' => 'required',
                'select_floor_id' => 'required',
                'select_flat_id' => 'required',
                'rent_date' => 'required',
                'tenant_name' => 'required',
                'mobile_no' => 'required',
                'advance' => 'required|numeric',
            ],
        );


        try {

            $user_id = Auth::user()->id;


            $flatrent = FlatRent::findOrFail($id);
            // dd($flatrent);
            //  __insert flat rent data__ //
            $flatrent->update([
                'created_by' => $user_id,
                'house_id' => $request->select_house_id,
                'floor_id' => $request->select_floor_id,
                'flat_id' => $request->select_flat_id,
                "rent_date" => date("Y-m-d", strtotime($request->rent_date)),
                'tenant_name' => $request->tenant_name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'advance_amount' => $request->advance,
                'meter_reading' => $request->meter_reading,
                'rent_amount' => $request->rent_amount,
            ]);

            // dd($flatrent);

            // insert electric meter reading
            $houseInfo = House::find($request->select_house_id);
            $flatInfo = Flat::find($request->select_flat_id);

            $rent_date = new Carbon(date("Y-m-d", strtotime($request->rent_date)));

            $elct = $flatrent->electric_meter_reading()->update([
                "house_id" => $request->select_house_id,
                "year_id"   => $rent_date->year,
                "month_id" => $rent_date->month,
            ], [
                "previous_meter_reading" => $request->meter_reading,
                "rate" => $flatInfo->type == "shop" ? $houseInfo->business_electric_bill : $houseInfo->domestic_electric_bill
            ]);
            // dd($elct);

            $tenant_ledger = $flatrent->tenant_ledger;
            // dd($tenant_ledger);

            $tenant_ledger->update([
                "action_date" => date("Y-m-d", strtotime($request->rent_date)),
                "flat_rent_id" => $flatrent->id,
                "account_id" => $request->account_id,
                "year_id" => $rent_date->year,
                "month_id" => $rent_date->month,
                "cr" =>  $request->advance,
                "comment" => "Rent Advance"
            ]);
            // dd($tenant_ledger);




            // Update the AccountLedger entry
            $account_ledger = AccountLedger::where('type', 'rent_advance')
                ->where('reff_id', $tenant_ledger->id)->first();

            $account_ledger->update([
                "action_date" => $request->rent_date,
                "account_id" => $request->account_id,
                "comment" => "Rent Advance",
                "cr" => $request->advance
            ]);

            // dd($account_ledger);



            // __insert into flat_rent_bill__ //
            $billconfigs = $request->input('billconfig');
            $amounts = $request->input('amount');
            $amounts = array_values(array_filter($amounts));

            $flatrent->rentBillConfigs()->delete();

            $billConfig = [];

            // user config
            foreach ($billconfigs as $key => $value) {
                $billConfig[] = [
                    'bill_config_id' => $value,
                    'amount' => $amounts[$key],
                ];
            }

            // system config
            // 1 = rent amount
            // 2 = electric bill
            $systemConfig = BillConfig::whereIn("type", [1, 2])->get();

            foreach ($systemConfig as $item) {
                $billConfig[] = [
                    'bill_config_id' => $item->id,
                    'amount' => $item->type == 1 ? $request->rent_amount : 0
                ];
            }

            $flatrent->rentBillConfigs()->createMany($billConfig);



            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Flat rent updated successfully.']);
        } catch (\Exception $e) {
            DB::rollback();

            dd($e);

            return response()->json(['status' => 'error',  'message' => 'Error saving flat rent.']);
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
        FlatRent::find($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Flat rent deleted successfully.']);
    }

    public function getFloorsByHouse($houseId)
    {
        $floors = Floor::where('house_id', $houseId)->get();
        //dd($floors);
        return response()->json(['floors' => $floors]);
    }

    public function getFlatByFloor($floorId)
    {
        $flats = Flat::where('floor_id', $floorId)->get();
        //dd($flats);
        return response()->json(['flats' => $flats]);
    }
}
