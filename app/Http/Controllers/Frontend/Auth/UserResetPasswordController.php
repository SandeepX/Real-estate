<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ResetsPasswords;

use Auth;
use Password;


class UserResetPasswordController extends Controller
{
    //
    use ResetsPasswords;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null) {
        return view('frontend.auth.passwords.reset')
            ->with(['token' => $token, 'email' => $request->email]
            );
    }
}
