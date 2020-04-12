<?php

namespace SIC\Http\Controllers;

use Auth;
use JavaScript;
use SIC\Models\Admin;
use SIC\Models\Client;
use Illuminate\Http\Request;

class AdminRolesController extends Controller
{
	public function client_login($id) {
		
		$user = Client::findOrFail($id)->first();

		if ($user && !$user->acc_terminated) {
			Auth::guard('client')->loginUsingId($id);
			return redirect()->route('client.dashboard');
		}
		else
		{
			return redirect()->route('admin.manageClient')->with('error', "Error logging in. The account is terminated or the user does not exist.");
		}
	}

	public function admin_login($id) {
		
		$user = Admin::findOrFail($id)->first();

		if ($user && !$user->acc_terminated) {
			Auth::guard('admin')->loginUsingId($id);
			return redirect()->route('admin.dashboard');
		}
		else
		{
			return redirect()->route('admin.manageAdmin')->with('error', "Error logging in. The account is terminated or the user does not exist.");
		}
	}

	public function client_update(Request $request) {
		$this->validate($request, [
            'id' => 'required|integer',
            'username' => 'required|alpha_dash|max:20',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

		$user = Client::findOrFail($request->input('id'))->first();

		if($user)
		{
			$user->update([
				'username' => $request->input('username'),
				'password' => bcrypt($request->input('password'))
			]);

			return response()->json($user);
		}
		else
		{
			return response('This client doesn\'t exists', 404);
		}
	}

	public function admin_update(Request $request) {
		$this->validate($request, [
            'id' => 'required|integer',
            'email' => 'required|email',
            'username' => 'required|alpha_dash|max:20',
            'first_name' => 'required|alpha|max:20',
            'last_name' => 'required|alpha|max:20',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

		$user = Admin::findOrFail($request->input('id'))->first();

		if($user)
		{
			$user->update([
				'username' => $request->input('username'),
				'first_name' => $request->input('first_name'),
				'last_name' => $request->input('last_name'),
				'email' => $request->input('email'),
				'password' => bcrypt($request->input('password'))
			]);

			$javascript = JavaScript::put([
		        'admin_updated_at' => $user->updated_at->diffForHumans(),
		        'admin_name' => $user->getNameOrUsername(),
		        'admin' => $user
	        ]);

			return response()->json($javascript);
		}
		else
		{
			return response('This admin doesn\'t exists', 404);
		}
	}

	public function client_status(Request $request) {
		$this->validate($request, [
            'id' => 'required|integer',
            'method' => 'required|alpha|in:terminate,activate'
        ]);

        $user = Client::findOrFail($request->input('id'));

        if ($user) {
        	if($request->input('method') === 'terminate')
	        {
	        	$user->update([
					'acc_terminated' => true
				]);
	        	return response("Account terminated successfully.");
	        }
	        else if($request->input('method') === 'activate')
	        {
	        	$user->update([
					'acc_terminated' => false
				]);
	        	return response("Account activated successfully.");
	        }
        }
        else
        {
        	return response('This client doesn\'t exists', 404);
        }
	}

	public function admin_status(Request $request) {
		$this->validate($request, [
            'id' => 'required|integer',
            'method' => 'required|alpha|in:terminate,activate'
        ]);

        $user = Admin::findOrFail($request->input('id'));

        if ($user) {
        	if($request->input('method') === 'terminate')
	        {
	        	$user->update([
					'acc_terminated' => true
				]);
	        	return response("Account terminated successfully.");
	        }
	        else if($request->input('method') === 'activate')
	        {
	        	$user->update([
					'acc_terminated' => false
				]);
	        	return response("Account activated successfully.");
	        }
        }
        else
        {
        	return response('This admin doesn\'t exists', 404);
        }
	}

	public function client_delete(Request $request)
	{
		$this->validate($request, [
            'id' => 'required|integer'
        ]);

        $user = Client::findOrFail($request->input('id'));

        if ($user) {
        	$user->delete();
        	return response("Account deleted successfully.");
        }
        else
        {
        	return response('This client doesn\'t exists', 404);
        }
	}

	public function admin_delete(Request $request)
	{
		$this->validate($request, [
            'id' => 'required|integer'
        ]);

        $user = Admin::findOrFail($request->input('id'));

        if ($user) {
        	$user->delete();
        	return response("Account deleted successfully.");
        }
        else
        {
        	return response('This admin doesn\'t exists', 404);
        }
	}
}