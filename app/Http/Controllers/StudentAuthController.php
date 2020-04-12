<?php

namespace SIC\Http\Controllers;

use Auth;
use Validator;
use SIC\Models\Student;
use Illuminate\Http\Request;
use SIC\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class StudentAuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/student/dashboard';
    protected $guard = 'student';
    protected $loginView = 'student.login';
    // protected $registerView = 'admin.AddAdmin';
    protected $username = 'username';
    protected $redirectAfterLogout = '/student/login';

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

        $student = Student::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);

        return response()->json($student);
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required|alpha_dash|max:20',
            'password' => 'required'
        ]);

        $user = Student::where('username', $request->only(['username']))->firstOrFail();

        if($user->acc_terminated)
        {
            // Account is terminated
            return redirect()->back()->with('error', "This account is terminated. Please contact the administrator.");
        }
        else
        {
            // Account is OK => Proceed to login
            if(!Auth::guard('student')->attempt($request->only(['username', 'password']), $request->has('remember')))
            {
                return redirect()->back()->with('error', 'Could not sign you in with those details.');
            }
            else
            {
                return redirect()->route('student.dashboard')->with('success', 'You are logged in successfully.');
            }
        }
    }
}
