<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function index(){
        $food = new Food();
        $data['food'] = $food->data()->get();
        return view('food/index', $data);
    }

    public function add(){
        return view('food/add');
    }

    public function edit($id){
        $food = new Food();

        $query = $food->data('food.id', $id);
        if($query->count() == 0){
            return redirect('food')->with('alert', show_alert('Data tunawisma tidak ditemukan', 'danger'));
        }

        $data = [
            'food' => $query->first()
        ];
        return view('food/edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'food_name'         => 'required',
            'food_description'  => 'required',
            'price'             => 'required|numeric|gt:0',
            'food_photo'        => 'mimes:jpeg,jpg,png'
        ]);
        $input = $request->except(['_token']);
        $input['updated_at'] = date('Y-m-d H:i:s');

        if(isset($input['food_photo'])){
            $imageName = 'food_'.time().'.'.$request->file('food_photo')->extension();  
            $request->file('food_photo')->move(public_path('images/food'), $imageName);
            $input['food_photo'] = $imageName;
        }   
        
        $food = new Food();
        $food->updates($input, $id);

        return redirect('food')->with('alert', show_alert('Data makanan berhasil diubah', 'success'));
    }

    public function insert(Request $request){
        $request->validate([
            'food_name'         => 'required',
            'food_description'  => 'required',
            'price'             => 'required|numeric|gt:0',
            'food_photo'        => 'required|mimes:jpeg,jpg,png'
        ]);

        $imageName = 'food_'.time().'.'.$request->file('food_photo')->extension();  
        $request->file('food_photo')->move(public_path('images/food'), $imageName);

        $input = $request->except(['_token']);
        $input['food_photo'] = $imageName;
        $input['created_at'] = date('Y-m-d H:i:s');

        $food = new Food();
        $food->create($input);

        return redirect('food')->with('alert', show_alert('Data makanan berhasil ditambahkan', 'success'));    
    }

    public function delete($id){
        $food = new Food();
        $food->deletes($id);

        return redirect('food')->with('alert', show_alert('Data tunawisma berhasil dihapus', 'success'));
    }
}
