<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile');
    }

    public function updateUserDetails(Request $req)
    {
        $req->validate([
            'name' => ['required','string'],
            'phone' => ['required','numeric','max_digits:10','min_digits:10'],
            'pin_code' => ['required','digits:6'],
            'address' => ['required','string','max:500'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        
        $user->update([
            'name' => $req->name,
        ]);

        $user->userDetail()->updateOrCreate(

            [
                'user_id' => $user->id,
            ],
            [
                'phone' => $req->phone,
                'pin_code' => $req->pin_code,
                'address' => $req->address,
            ]
        );  
        
        return redirect()->back()->with('messageUser','User Profile Updated');
    }

    public function passwordCreate()
    {
        return view('frontend.users.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('messagePass','Password Updated Successfully');

        }
        else{

            return redirect()->back()->with('PassFausse','Current Password Does Not Match With Old Password');
        }
    }

    public function mailInvoice($id)
    {
        $order = Order::findOrFail($id);
        
        return view('frontend.users.mail-invoice',compact('order'));

    }
}
