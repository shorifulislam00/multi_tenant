<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Floor;
use App\Models\Flat;
use DataTables;
use Illuminate\Support\Facades\Auth;

class FlatController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index(Request $request)
    {

        $user_id = Auth::user()->id;
        if ($request->ajax()) {

            $data = Flat::with(['house', 'floor'])
                ->when($request->house_id > 0, function ($q) {
                    $q->where("house_id", request('house_id'));
                })
                ->when($request->floor_id > 0, function ($q) {
                    $q->where("floor_id", request('floor_id'));
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
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn-transition btn btn-outline-primary btn-sm editFlat"> <i class="fas fa-edit"></i>Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn-transition btn btn-outline-danger btn-sm deleteFlat"><i class="fas fa-trash"></i>Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $houses = House::where('created_by', $user_id)->get();
        $floors = Floor::where('created_by', $user_id)->get();


        return view('admin.flat.index', compact('houses', 'floors'));
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


        $request->validate([
            'house_name' => 'required',
            'floor_name' => 'required',
            'flat_type' => 'required',
            'flat_number' => 'required',
            'squre_feet' => 'required',
            'rent_amount' => 'required',


        ]);

        try {
            $id = $request->id;
            $user_id = Auth::user()->id;

            $data = [
                'created_by' => $user_id,
                'house_id' => $request->house_name,
                'floor_id' => $request->floor_name,
                'type' => $request->flat_type,
                'flat_number' => $request->flat_number,
                'description' => $request->description,
                'sqr_feet' => $request->squre_feet,
                'sell_rate' => $request->sell_rate,
                'rent_amount' => $request->rent_amount,

            ];

            Flat::updateOrCreate(

                ['id' => $request->id],
                $data

            );
            $message = $id ? 'Flat updated successfully.' : 'Flat created successfully.';

            return response()->json(['status' => 'success', 'message' => $message]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'message' => 'Failed to save Flat data.']);
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
        $flats = Flat::findOrfail($id);
        $floors = Floor::where('house_id', $flats->house_id)->get();

        //dd($floors);

        $data = [
            'flats' => $flats,
            'floors' => $floors,
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Flat::find($id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Flat deleted successfully.']);
    }


    // get floor dynamic
    public function getFloorsByHouse($houseId)
    {

        $floors = Floor::where('house_id', $houseId)->get();
        //dd($floors);

        return response()->json(['floors' => $floors]);
    }
}
