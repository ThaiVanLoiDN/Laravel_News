<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\User;

class AuthController extends Controller
{
    public function getLogin()
    {
    	return view('auth.login');
    }
    public function postLogin(AuthRequest $request)
    {
    	$username = trim($request->username);
    	$password = trim($request->password);

    	if  ((Auth::attempt(['username' => $username, 'password' => $password])) && (Auth::user()->capbac != 0)) {
    		return redirect()->route('admin.index.index');
    	}else{
    		$request->session()->flash('msgDanger', 'Sai username hoặc mật khẩu');
    		return redirect()->route('admin.auth.login');
    	}
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('public.index.index');
    }
}
