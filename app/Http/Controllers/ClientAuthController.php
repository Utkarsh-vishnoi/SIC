<?php

namespace SIC\Http\Controllers;

use Auth;
use Validator;
use JavaScript;
use SIC\Models\Client;
use Illuminate\Http\Request;
use SIC\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class ClientAuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/dashboard';
    protected $guard = 'client';
    protected $loginView = 'client.login';
    protected $username = 'username';
    protected $redirectAfterLogout = '/';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'register']]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:clients|alpha_dash|max:20',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $client = Client::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'acc_terminated' => false
        ]);

        $javascript = JavaScript::put([
        'client_created_at' => $client->created_at->diffForHumans(),
        'client_updated_at' => $client->updated_at->diffForHumans(),
        'client' => $client,
        'client_login_route' => route('adminroles.clientlogin', ['id' => $client->id])
        ]);
        
         return response()->json($javascript);
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required|alpha_dash|max:20',
            'password' => 'required'
        ]);

        $user = Client::where('username', $request->only(['username']))->firstOrFail();

        if($user->acc_terminated)
        {
            // Account is terminated
            return redirect()->back()->with('error', "This account is terminated. Please contact the administrator.");
        }
        else
        {
            // Account is OK => Proceed to login
            if(!Auth::guard('client')->attempt($request->only(['username', 'password']), $request->has('remember')))
            {
                return redirect()->back()->with('error', 'Could not sign you in with those details.');
            }
            else
            {
                return redirect()->route('client.dashboard')->with('success', 'You are logged in successfully.');
            }
        }
    }
}
