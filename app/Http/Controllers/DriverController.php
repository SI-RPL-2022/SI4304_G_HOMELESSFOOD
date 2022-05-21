<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Transaction;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function detail($transaction_id){
        $transaction = new Transaction();
        $userData = Session::get('user');

        $query = $transaction->data([
                    'transaction.id' => $transaction_id,
                    'driver_id' => $userData->id,
                    'status'    => 'on_delivery'
                 ]);

        if($query->count() == 0){
            return redirect('dashboard')->with('alert', show_alert('Data transaksi tidak ditemukan', 'danger'));
        }

        $data = [
            'transaction' => $query->first(),
            'item'        => DB::table('transaction_detail')
                             ->join('food', 'food.id', '=', 'transaction_detail.food_id')
                             ->where('transaction_id', $transaction_id)->get()
        ];
        
        return view('driver/detail', $data);
    }

    public function completeOrder($transaction_id){
        $transaction = new Transaction();
        $userData = Session::get('user');
        $query = $transaction->data([
                    'transaction.id' => $transaction_id,
                    'driver_id' => $userData->id,
                    'status'    => 'on_delivery'
                 ]);

        if($query->count() == 0){
            return redirect('dashboard')->with('alert', show_alert('Data transaksi tidak ditemukan', 'danger'));
        }

        $transaction->updates([
            'status' => 'complete',
            'complete_at' => date('Y-m-d H:i:s')
        ], $transaction_id);

        $user = new User();
        $user->updates([
            'status_duty' => 'free'
        ], $userData->id);

         return redirect('dashboard')->with('alert', show_alert('Pesanan berhasil diselesaikan', 'success'));
    }

    public function history(){
        $transaction = new Transaction();
        $userData = Session::get('user');
        $query = $transaction->data([
                    'driver_id' => $userData->id,
                    'status'    => 'complete'
                 ]);
        $data['transaction'] = $query->get();

        return view('driver/history', $data);
    }

    public function historyDetail($transaction_id){
        $transaction = new Transaction();
        $userData = Session::get('user');
        $query = $transaction->data([
                    'driver_id' => $userData->id,
                    'status'    => 'complete'
                 ]);

        if($query->count() == 0){
            return redirect('dashboard')->with('alert', show_alert('Data transaksi tidak ditemukan', 'danger'));
        }

        $data = [
            'transaction' => $query->first(),
            'item'        => DB::table('transaction_detail')
                             ->join('food', 'food.id', '=', 'transaction_detail.food_id')
                             ->where('transaction_id', $transaction_id)->get()
        ];

        return view('driver/history_detail', $data);
    }

    public function add(){
        return view('driver/add');
    }

    public function insert(Request $request){
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required',
            'no_hp'     => 'required',
            'password'  => 'required',
            'foto'      => 'required|mimes:jpeg,jpg,png'
        ]);

        $imageName = 'driver_'.time().'.'.$request->file('foto')->extension();  
        $request->file('foto')->move(public_path('gambar'), $imageName);

        $input = $request->except(['_token']);
        $input['foto'] = $imageName;
        $input['akses'] = 'driver';
        $input['created_at'] = date('Y-m-d H:i:s');

        $user = new User();
        $user->create($input);

        return redirect('dashboard')->with('alert', show_alert('Data driver berhasil ditambahkan', 'success'));    
    }

    public function delete($id){
        $driver = new User();
        $driver->deletes($id);

        return redirect('dashboard')->with('alert', show_alert('Data driver berhasil dihapus', 'success'));
    }

    public function edit($id){
        $driver = new User();

        $query = $driver->data('user.id', $id);
        if($query->count() == 0){
            return redirect('dashboard')->with('alert', show_alert('Data driver tidak ditemukan', 'danger'));
        }

        $data = [
            'driver' => $query->first()
        ];
        return view('driver/edit', $data);
    }

    public function update(Request $request, $id){
         $request->validate([
            'nama'      => 'required',
            'email'     => 'required',
            'no_hp'     => 'required',
            'password'  => 'required',
            'foto'      => 'mimes:jpeg,jpg,png'
        ]);
        $input = $request->except(['_token']);
        $input['updated_at'] = date('Y-m-d H:i:s');

        if(isset($input['foto'])){
            $imageName = 'driver_'.time().'.'.$request->file('foto')->extension();  
            $request->file('foto')->move(public_path('gambar'), $imageName);
            $input['foto'] = $imageName;
        }   
        
        $driver = new User();
        $driver->updates($input, $id);

        return redirect('dashboard')->with('alert', show_alert('Data driver berhasil diubah', 'success'));
    }
}
