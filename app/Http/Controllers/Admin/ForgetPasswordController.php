<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function showLinkRequestForm(){
        return view('admin.passwords.ForgetPassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate($request, ['email' => 'required|email']);
        $response = Password::sendResetLink($request->only('email'));
        return $response == Password::RESET_LINK_SENT
            ? redirect()->back()->with('status', __($response))
            : redirect()->back()->withErrors(['email' => __($response)]);
    }
}

