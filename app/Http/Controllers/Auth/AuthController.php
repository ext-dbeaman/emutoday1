<?php
namespace emutoday\Http\Controllers\Auth;

use emutoday\User;
use emutoday\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectAfterLogout = route('auth.login');
        $this->redirectTo = route('admin.dashboard');
        $this->middleware('guest', ['except' => 'getLogout']);
    }

		public function authenticate()
		{
			if(Auth::attempt(['email'=> $email, 'password'=> $password])){
				//Authenticate passed
				return redirect()->intended('admin.dashboard');
				
			}
		}
}
