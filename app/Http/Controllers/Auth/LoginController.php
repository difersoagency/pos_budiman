<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', '=', $username)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Incorrect username or password ');
        }
        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', 'Incorrect username or password');
        }
        echo $this->username;
    }


    public function username()
    {
        $login = request()->input('username');

        $fieldType = 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }


    public function authenticated()
    {
        if (auth()->user()->level_user_id == '1') {
            return redirect()->route('home_owner');
        } else if (auth()->user()->level_user_id == '2') {
            return redirect()->route('home_admin');
        } else if (auth()->user()->level_user_id == '3') {
            return redirect()->route('home_kasir');
        }
    }
}
