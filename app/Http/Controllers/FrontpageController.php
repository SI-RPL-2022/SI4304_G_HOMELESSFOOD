<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Session;

class FrontpageController extends Controller
{
    public function driverHiring(){
        return view('hiring');
    }

    public function registerDriver(){
        return view('hiringRegister');
    }

    public function do_register_driver(Request $request){
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'no_hp'     => 'required'
        ]);

        $input = $request->except(['_token']);
        $input['akses'] = 'driver';
        $input['is_active'] = '0';
        $user = new User();

        if($user->data('email', $input['email'])->count() > 0){
            return redirect('driver_hiring/register')->with('alert', show_alert('Email sudah terdaftar, coba gunakan email yang lain', 'danger'));
        }

        if($user->data('no_hp', $input['no_hp'])->count() > 0){
            return redirect('driver_hiring/register')->with('alert', show_alert('Nomor Handphone sudah terdaftar, coba gunakan nomor handphone yang lain', 'danger'));
        }

        $user->create($input);
        return redirect('driver_hiring/register')->with('alert', show_alert('Pendaftaran berhasil, silahkan tunggu EMAIL / SMS KONFIRMASI dari kami', 'success'));
    }

    public function verificationDriver(){
        if(!is_admin()){
            return redirect('');
        }

        $user = new User();
        $data['driver'] = $user->data([
                            'akses' => 'driver',
                            'is_active' => '0'
                          ])->get();
        return view('dashboardVerification', $data);
    }

    public function doVerificationDriver($status, $user_id){
        if(!is_admin()){
            return redirect('');
        }

        if(!in_array($status, ['accept', 'deny'])){
            return redirect('driver_verification')->with('alert', show_alert('Status tidak diketahui', 'danger'));
        }

        $user = new User();
        $isExist = $user->data([
                    'akses' => 'driver',
                    'is_reject' => '0',
                    'is_active' => '0',
                    'id' => $user_id
                   ])->count();

        if($isExist == 0){
            return redirect('driver_verification')->with('alert', show_alert('Data driver tidak diketahui', 'danger'));
        }

        $data = [
            'is_active' => $status == 'accept' ? '1' : '0',
            'is_reject' => $status == 'accept' ? '0' : '1'
        ];
        $user->updates($data, $user_id);
        return redirect('driver_verification')->with('alert', show_alert('Data driver berhasil diverifikasi', 'success'));
    }

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

        if($userData->first()->is_active == '0'){
            return redirect('auth/login')->with('alert', show_alert('Akun belum aktif, jika kamu sedang melakukan pendaftaran driver, silahkan tunggu email / sms konfirmasi dari kami', 'danger'));
        }

        Session::put('user', $userData->first());
        return redirect('/dashboard');
    }

    public function dashboard(){
    	$userData = Session::get('user');
    	if(!$userData){
    		return redirect('auth/login');
    	}

        $data = [];
        if($userData->akses == 'driver'){
            $transaction = new Transaction();
            $view = 'driver/dashboard';
            $data['transaction'] = $transaction->data([
                                    'driver_id' => Session::get('user')->id,
                                    'status' => 'on_delivery'
                                   ])->get();
        }else{

            if($userData->akses == 'admin'){
                $driver = new User();
                $data['driver'] = $driver->data([
                                    'akses' => 'driver',
                                    'is_active' => '1'
                                  ])->get();
            }

            $view = 'dashboard';
        }
    	return view($view, $data);
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
