<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\BillConfig;
use Illuminate\Http\Request;

// class BillConfigController extends Controller
// {

//   /**
//    * Display a listing of the resource.
//    *
//    * @return Response
//    */
//   public function index(Request $request)
//   {

//     if ($request->ajax()) {

//         $data = BillConfig::latest()
//                             ->whereIn('type', [0, null])
//                             ->get();

//         return DataTables::of($data)
//                 ->addIndexColumn()
//                 ->addColumn('action', function($row){

//                     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBillConfig"> <i class="fas fa-edit"></i> Edit</a>';

//                     $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBillConfig"><i class="fas fa-trash"></i> Delete</a>';

//                      return $btn;
//                 })
//                 ->rawColumns(['action'])
//                 ->make(true);
//     }

//     return view('admin.bill-config.index');

//   }

//   /**
//    * Show the form for creating a new resource.
//    *
//    * @return Response
//    */
//   public function create()
//   {

//   }

//   /**
//    * Store a newly created resource in storage.
//    *
//    * @return Response
//    */
//   public function store(Request $request)
//   {
//         $request->validate(
//             [
//                 'bill_category_name' => 'required',
//             ],
//         );

//         try{

//             BillConfig::updateOrCreate(

//                 ['id' => $request->id],
//                 [
//                     'name' => $request->bill_category_name,
//                 ]

//                 );

//                 return response()->json(['status' => 'success', 'message'=>'Bill category saved successfully.']);
//             } catch(\Exception $e){
//                 return response()->json(['status' => 'error', 'message'=>'Fail to save data.']);
//             }
//   }

//   /**
//    * Display the specified resource.
//    *
//    * @param  int  $id
//    * @return Response
//    */
//   public function show($id)
//   {

//   }

//   /**
//    * Show the form for editing the specified resource.
//    *
//    * @param  int  $id
//    * @return Response
//    */
//   public function edit($id)
//   {
//     $billCategory = BillConfig::find($id);
//     return response()->json($billCategory);
//   }

//   /**
//    * Update the specified resource in storage.
//    *
//    * @param  int  $id
//    * @return Response
//    */
//   public function update($id)
//   {

//   }

//   /**
//    * Remove the specified resource from storage.
//    *
//    * @param  int  $id
//    * @return Response
//    */
//   public function destroy($id)
//   {
//     BillConfig::find($id)->delete();
//     return response()->json([ 'status' => 'success' ,'message'=>'Bill Category deleted successfully.']);
//   }

// }
