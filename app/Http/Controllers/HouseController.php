<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class HouseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        // dd($data);
        if ($request->ajax()) {


            $user_id = Auth::user()->id;
            $data = House::where('created_by', $user_id)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn-transition btn btn-outline-primary btn-sm editHouse"> <i class="fas fa-edit"></i> Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn-transition btn btn-outline-danger btn-sm deleteHouse"><i class="fas fa-trash"></i> Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.house.index');
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

        // $user_id = Auth::user()->id;
        // dd($user_id);
        $request->validate(
            [
                'house_name' => 'required',
                'address' => 'required',
            ],
        );

        try {

            if (Auth::user()) {

                $user_id = Auth::user()->id;

                House::create([
                    'created_by' => $user_id,
                    'name' => $request->house_name,
                    'description' => $request->description,
                    'address' => $request->address,
                    "start_date" => date("Y-m-d", strtotime($request->start_date)),
                    'business_electric_bill' => $request->business_electric_bill,
                    'domestic_electric_bill' => $request->domestic_electric_bill,

                ]);
            }



            return response()->json(['status' => 'success', 'message' => 'House created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Fail to save data.']);
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
        $House = House::find($id);
        return response()->json($House);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $House = House::find($id);
            if (Auth::user()) {

                $user_id = Auth::user()->id;
                $House->update([
                    'created_by' => $user_id,
                    'name' => $request->house_name,
                    'description' => $request->description,
                    'address' => $request->address,
                    "start_date" => date("Y-m-d", strtotime($request->start_date)),
                    'business_electric_bill' => $request->business_electric_bill,
                    'domestic_electric_bill' => $request->domestic_electric_bill,

                ]);
            }





            return response()->json(['status' => 'success', 'message' => 'House updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Fail to save data.']);
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
        House::find($id)->delete();

        return response()->json(['status' => 'success', 'message' => 'House deleted successfully.']);
    }
}
