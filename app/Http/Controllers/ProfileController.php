<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class ProfileController extends Controller
{
    public function changeBio(Request $request){
        $request->validate([
            'nama'   => 'required',
            'no_hp'  => 'required',
            'foto'  => 'required|mimes:jpeg,jpg,png'
        ]);
        $input = $request->except(['_token']);

        if(isset($input['foto'])){
            $imageName = 'profile_'.time().'.'.$request->file('foto')->extension();  
            $request->file('foto')->move(public_path('gambar'), $imageName);
            $input['foto'] = $imageName;
        } 

        $userId = Session::get('user')->id;
        $user = new User();
        $user->updates($input, $userId);

        Session::put('user', $user->data('id', $userId)->first());
        return redirect('profile')->with('alert', show_alert('Profile berhasil diubah', 'success'));
    }

    public function changePassword(Request $request){
        $request->validate([
            'password'   => 'required'
        ]);

        $userId = Session::get('user')->id;
        $input = $request->except(['_token']);
        $user = new User();
        $user->updates($input, $userId);

        Session::put('user', $user->data('id', $userId)->first());
        return redirect('profile')->with('alert', show_alert('Password berhasil diubah', 'success'));
    }
}
