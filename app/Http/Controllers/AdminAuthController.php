<?php

namespace SIC\Http\Controllers;

use Auth;
use Crypt;
use Validator;
use JavaScript;
use SIC\Models\Admin;
use TwoStepVerification;
use Illuminate\Http\Request;
use SIC\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AdminAuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $guard = 'admin';
    // protected $loginView = 'admin.login';
    protected $username = 'username';
    protected $redirectAfterLogout = '/admin/login';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'register']]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:admins|alpha_dash|max:20',
            'first_name' => 'required|alpha|max:20',
            'last_name' => 'required|alpha|max:20',
            'password' => 'required|min:8',
            'email' => 'required|email',
            'password_confirmation' => 'required|same:password'
        ]);

        $admin = Admin::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'password' => bcrypt($request->input('password')),
            'acc_terminated' => false,
            'active' => 'false'
        ]);

        $javascript = JavaScript::put([
        'admin_created_at' => $admin->created_at->diffForHumans(),
        'admin_updated_at' => $admin->updated_at->diffForHumans(),
        'admin' => $admin,
        'getNameOrUsername' => $admin->getNameOrUsername(),
        'admin_login_route' => route('adminroles.adminlogin', ['id' => $admin->id])
        ]);

        return response()->json($javascript);
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required|alpha_dash|max:20',
            'password' => 'required'
        ]);

        $user = Admin::where('username', $request->only(['username']))->firstOrFail();

        if($user->acc_terminated)
        {
            // Account is terminated
            return redirect()->back()->with('error', "This account is terminated. Please contact the administrator.");
        }
        else
        {
            // Account is OK => Proceed to login
            if(!Auth::guard('admin')->once($request->only(['username', 'password'])))
            {
                return redirect()->back()->with('error', 'Could not sign you in with those details.');
            }
            else
            {
                $remember = $request->has('remember') ? 1 : 0;
                $key = TwoStepVerification::generateTokenCode($user->username);
                $code = TwoStepVerification::getBarCodeUrl($user->username, "SIC", $user->username, 'SIC');

                if ($user->active) {
                    return view('admin.verify')->with('info', 'Enter the authentication code.')->with('user', $user)->with('remember', $remember)->with('secret', Crypt::encrypt($key));
                }
                else {
                    return view('admin.verify')->with('info', 'Enter the authentication code.')->with('qrcode', $code)->with('user', $user)->with('remember', $remember)->with('secret', Crypt::encrypt($key));
                }
                
            }
        }
    }

    public function verify(Request $request)
    {
        $admin = Admin::findOrFail($request->input('user_id'))->first();
        $key = Crypt::decrypt($request->input('secret'));
        if(TwoStepVerification::verify($key, $request->input('code'))) {
            $remember = (boolean)$request->input('remember');
            Auth::guard('admin')->loginUsingId($request->input('user_id'), $remember);
            $admin->update([
              'active' => true
            ]);
            return redirect()->route('admin.dashboard')->with("success", "You are successfully logged in.");
        }
        else
        {
            return view('admin.verify')->with('error', 'Invalid authentication code. Try again.')->with('user', $admin)->with('remember', $request->input('remember'))->with('secret', $request->input('secret'));
        }
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }
}
