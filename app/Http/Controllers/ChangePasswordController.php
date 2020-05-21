<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['preventbackbutton','auth']);
    }

    public function viewChangePass()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
       $request->validate([
           'oldPassword'    => ['required', new MatchOldPassword],
           'newPassword'    => ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', 'different:oldPassword'],
        //    'newPassword'    => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|different:oldPassword',
           'curNewPassword' => ['required_with:password', 'min:8'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newPassword)]);

        return redirect('/home')->with('success','Password Updated Successfully');
    }
}
