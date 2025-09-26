<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => ['required'],
                'email' => ['required',  'email',  'unique:'.User::class],
                'password' => ['required'],
            ]);



            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'password' => Hash::make($request->password),
            ]);



            // access permissions for the current user accounts
            $user->givePermissionTo('dashboard_view');
            $user->givePermissionTo('account_view');
            $user->givePermissionTo('account_edit');
            $user->givePermissionTo('account_delete');
            $user->givePermissionTo('account_balance');
            $user->givePermissionTo('account_ledger');
            $user->givePermissionTo('account_delete');

            // access permissions for the current user rent and bill

            $user->givePermissionTo('rent_view');
            $user->givePermissionTo('rent_edit');
            $user->givePermissionTo('rent_delete');
            $user->givePermissionTo('bill_generate_view');
            $user->givePermissionTo('bill_view');
            $user->givePermissionTo('bill_print');
            $user->givePermissionTo('bill_delete');
            $user->givePermissionTo('bill_category_list_view');
            $user->givePermissionTo('bill_category_edit');
            $user->givePermissionTo('bill_category_delete');
            $user->givePermissionTo('bill_payment_list_view');
            $user->givePermissionTo('bill_payment_edit');
            $user->givePermissionTo('bill_payment_delete');
            $user->givePermissionTo('bill_ledger_view');


            // permission for house

            $user->givePermissionTo('house_view');
            $user->givePermissionTo('house_edit');
            $user->givePermissionTo('house_delete');

            /// permission for floors

            $user->givePermissionTo('floor_view');
            $user->givePermissionTo('floor_edit');
            $user->givePermissionTo('floor_delete');

            // permission for flats

            $user->givePermissionTo('flat_view');
            $user->givePermissionTo('flat_edit');
            $user->givePermissionTo('flat_delete');


            // $user->givePermissionTo('user_view');
            // $user->givePermissionTo('user_edit');
            // $user->revokePermissionTo('user_delete');


            event(new Registered($user));

            // $user->assignRole('dashboard_view');
            $user->sendEmailVerificationNotification();



            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
            // return redirect()->route('login')->with('success', 'User registration successfully');


        } catch (\Exception $e) {
            // Handle the exception and return an error response
            dd($e);
            // DB::rollBack();

            return response()->json(['status' => 'error', 'message' => 'Failed to save data.']);
        }


    }
}
