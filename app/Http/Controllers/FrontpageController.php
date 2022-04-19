<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class FrontpageController extends Controller
{
    public function index(){
    	return view('home');
    }

    public function login(){
    	return view('auth/login');
    }

    public function register(){
    	return view('auth/register');
    }

    public function do_register(Request $request){
    	$request->validate([
            'nama'    	=> 'required',
            'email'     => 'required',
            'password'  => 'required',
            'no_hp'   	=> 'required'
        ]);

        $input = $request->except(['_token']);
        $input['akses'] = 'user';
        $user = new User();

        if($user->data('email', $input['email'])->count() > 0){
        	return redirect('auth/register')->with('alert', show_alert('Email sudah terdaftar, coba gunakan email yang lain', 'danger'));
        }

        $user->create($input);
        return redirect('auth/login')->with('alert', show_alert('Pendaftaran berhasil, silahkan login menggunakan akun anda', 'success'));
    }

    public function do_login(Request $request){
    	$request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $input = $request->except(['_token']);
        $user = new User();
        $userData = $user->data($input);
        if($userData->count() == 0){
        	return redirect('auth/login')->with('alert', show_alert('Akun tidak terdaftar, silahkan melakukan registrasi akun terlebih dahulu', 'danger'));
        }

        Session::put('user', $userData->first());
        return redirect('/dashboard');
    }

    public function dashboard(){
    	$userData = Session::get('user');
    	if(!$userData){
    		return redirect('auth/login');
    	}


    	return view('dashboard');
    }

    public function profile(){
    	$userData = Session::get('user');
    	if(!$userData){
    		return redirect('auth/login');
    	}

    	
    	return view('profile');
    }

    public function do_logout(){
    	Session::flush();
    	return redirect('auth/login');
    }
}
