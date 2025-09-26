<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = User::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route("user.edit", $row->id) . '" class="edit btn btn-info btn-sm"> <i class="fa fa-edit"></i> Edit</a>&nbsp;';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn-transition btn btn-outline-danger btn-sm deleteUser"><i class="fas fa-trash" ></i> Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        //    dd($request->all());
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]

        );

        DB::beginTransaction();


        try {
            // Update or create the user

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->givePermissionTo($request->permission);


            DB::commit();


            return redirect()->route("user.index")->with('success', 'User created successfully');
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            dd($e);
            DB::rollBack();

            return response()->json(['status' => 'error', 'message' => 'Failed to save data.']);
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
        $user = User::find($id);
        $permissions = $user->getAllPermissions()->pluck("id")->toArray();

        // dd($user->getAllPermissions()->pluck("id")->toArray());

        if (empty($user)) {
            return redirect()->route("user.index")->with('error', 'User not found');
        }

        return view('admin.user.edit', compact('user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,  $id)
    {

        // dd($request->all());

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]

        );

        DB::beginTransaction();


        try {
            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            $user->syncPermissions($request->permission);


            DB::commit();


            return redirect()->route("user.index")->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            dd($e);

            DB::rollBack();

            // Handle the exception and return an error response
            return response()->json(['status' => 'error', 'message' => 'Failed to save data.']);
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
        User::find($id)->delete();

        return response()->json(['status' => 'success', 'message' => 'User deleted successfully.']);
    }
}
