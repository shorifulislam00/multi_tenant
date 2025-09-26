<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Floor;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
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



            $data = Floor::with(['house'])
                ->when($request->house_id > 0, function ($q) {
                    $q->where("house_id", request('house_id'));
                })
                ->where('created_by', $user_id)
                ->get();
            // dd($data);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('house', function ($row) {
                    return $row->house->name;
                })

                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn-transition btn btn-outline-primary btn-sm editFloor"> <i class="fas fa-edit"></i> Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn-transition btn btn-outline-danger btn-sm deleteFloor"><i class="fas fa-trash"></i> Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $houses = House::where('created_by', $user_id)->get();
        // dd($houses);
        return view('admin.floor.index', compact('houses'));
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

            'select_house_id' => 'required',
            'name' => 'required',

        ]);


        try {

            $id = $request->id;

            $user_id = Auth::user()->id;

            $data = [
                'created_by' => $user_id,
                'house_id' => $request->select_house_id,
                'name' => $request->name
            ];

            Floor::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            $message = $id ? 'Floor updated successfully.' : 'Floor created successfully.';

            return response()->json(['status' => 'success', 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to save floor data.']);
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
        $floor = Floor::find($id);
        //dd($floor->photo);
        return response()->json($floor);
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
        Floor::find($id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Floor deleted successfully.']);
    }
}
