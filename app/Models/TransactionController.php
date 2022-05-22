<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Homeless;
use App\Models\Food;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Session;
use Closure;

class TransactionController extends Controller
{
    public function index(){
        if(!Session::has('user')) return redirect('auth/login');

        $transaction = new Transaction();
        $data['transaction'] = $transaction->data()->get();
        return view('transaction/index', $data);
    }

    public function add(){
        $homeless = new Homeless();
        $food = new Food();
        $data['homeless'] = $homeless->data()->get();
        $data['food']     = $food->data()->get();
        return view('transaction/add', $data);
    }

    public function edit($id){
        $transaction = new Transaction();

        $query = $transaction->data('transaction.id', $id);
        if($query->count() == 0){
            return redirect('transaction')->with('alert', show_alert('Data tunawisma tidak ditemukan', 'danger'));
        }

        $transactionData = $query->first();
        $cityId = '161';
        $sub = DB::table('subdistricts')
                ->where('subdis_id', $transactionData->subdis_id)
                ->first();

        $data = [
            'transaction' => $query->first(),
            'disId' => $sub->dis_id,
            'subdis'   => DB::table('subdistricts')->where('dis_id', $sub->dis_id)->get(),
            'dis'      => DB::table('districts')->where('city_id', $cityId)->get()
        ];
        return view('transaction/edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'              => 'required',
            'subdis_id'         => 'required',
            'location_detail'   => 'required',
            'total_count'       => 'required',
            'characteristic'    => 'required',
            'photo'             => 'mimes:jpeg,jpg,png'
        ]);
        $input = $request->except(['_token']);
        $input['updated_at'] = date('Y-m-d H:i:s');

        if(isset($input['photo'])){
            $imageName = 'transaction_'.time().'.'.$request->file('photo')->extension();  
            $request->file('photo')->move(public_path('images/transaction'), $imageName);
            $input['photo'] = $imageName;
        }   
        
        $transaction = new Transaction();
        $transaction->updates($input, $id);

        return redirect('transaction')->with('alert', show_alert('Data tunawisma berhasil diubah', 'success'));
    }

    public function insert(Request $request){
        $request->validate([
            'homeless_id' => 'required',
            'qty'         => 'required'
        ]);

        $homeless = new Homeless();
        $input = $request->except(['_token']);

        echo "<pre>".print_r($input, true)."</pre>";

        $transDetail = [];
        $totalPrice = $totalQty = 0;

        foreach($input['qty'] as $key => $val){
            if(!in_array($val, ['', 0])){
                $totalQty += $val; 
                $totalPrice += $val * $input['food_price'][$key];
                $transDetail[] = [
                    'price'         => $input['food_price'][$key],
                    'total_price'   => $val * $input['food_price'][$key],
                    'qty'           => $val,
                    'food_id'       => $key
                ];
            }
        }

        $homelessJson = json_encode($homeless->data('homeless.id', $input['homeless_id'])->first());
        $transaction_id = DB::table('transaction')->insertGetId([
            'user_id' => Session::get('user')->id,
            'transaction_code' => rand(),
            'total_price'      => $totalPrice,
            'total_food'       => $totalQty,
            'homeless_data'    => $homelessJson,
            'created_at'       => date('Y-m-d H:i:s')
        ]);

        foreach($transDetail as $key => $val){
            $transDetail[$key]['transaction_id'] = $transaction_id; 
        }
        DB::table('transaction_detail')->insert($transDetail);

        return redirect('transaction')->with('alert', show_alert('Data transaksi berhasil ditambahkan', 'success'));    
    }

    public function detail($transaction_id){
        $transaction = new Transaction();
        
        $query = $transaction->data('transaction.id', $transaction_id);
        if($query->count() == 0){
            return redirect('transaction')->with('alert', show_alert('Data transaksi tidak ditemukan', 'danger'));
        }

        $data = [
            'transaction' => $query->first(),
            'item'        => DB::table('transaction_detail')
                             ->join('food', 'food.id', '=', 'transaction_detail.food_id')
                             ->where('transaction_id', $transaction_id)->get()
        ];

        if(in_array($data['transaction']->status, ['verified', 'on_delivery', 'complete'])){
            $user = new User();
            $data['driver'] = $user->data([
                                'akses' => 'driver',
                                'status_duty' => 'free'
                              ])->get();
        }
        
        return view('transaction/detail', $data);
    }

    public function uploadPayment(Request $request, $transaction_id){
        $request->validate([
            'payment_proof' => 'required|mimes:jpeg,jpg,png'
        ]);

        $input = $request->except(['_token']);

        $imageName = 'payment_'.time().'.'.$request->file('payment_proof')->extension();  
        $request->file('payment_proof')->move(public_path('images/payment'), $imageName);

        $transaction = new Transaction();
        $transaction->updates([
            'payment_proof' => $imageName,
            'status'    => 'need_confirmation',
            'upload_at' => date('Y-m-d H:i:s')
        ], $transaction_id);
        return redirect('transaction')->with('alert', show_alert('Bukti transfer berhasil diupload', 'success'));    
    }

    public function validationPayment(Request $request, $transaction_id, $status){
        if(!in_array($status, ['confirm', 'deny'])) return redirect('transaction/detail/'.$transaction_id);

        $transaction = new Transaction();
        $transData = $transaction->data('transaction.id', $transaction_id)->first();
        
        if($transData->status != 'need_confirmation'){
            return redirect('transaction/detail/'.$transaction_id)->with('alert', show_alert('Status transaksi tidak valid', 'danger'));
        }

        $transaction->updates([
            'status' => $status == 'confirm' ? 'verified' : 'deny',
            'confirm_at' => date('Y-m-d H:i:s')
        ], $transaction_id);

        return redirect('transaction/detail/'.$transaction_id)->with('alert', show_alert('Bukti pembayaran berhasil divalidasi', 'success'));
    }

    public function selectDriver(Request $request, $transaction_id){
        $transaction = new Transaction();
        $transData = $transaction->data('transaction.id', $transaction_id)->first();

        if($transData->status != 'verified'){
             return redirect('transaction/detail/'.$transaction_id)->with('alert', show_alert('Status transaksi tidak valid', 'danger'));
        }

        $input = $request->except(['_token']);
        $transaction->updates([
            'driver_id' => $input['user_id'],
            'status' => 'on_delivery',
            'delivery_at' => date('Y-m-d H:i:s')
        ], $transaction_id);

        $user = new User();
        $user->updates([
            'status_duty' => 'on_duty'
        ], $input['user_id']);

        return redirect('transaction/detail/'.$transaction_id)->with('alert', show_alert('Driver berhasil dipilih', 'success'));
    }
}
