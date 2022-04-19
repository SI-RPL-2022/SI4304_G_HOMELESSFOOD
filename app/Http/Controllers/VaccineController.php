<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccine;

class VaccineController extends Controller
{

    public function index(){
    	$vaccine = new Vaccine();
		$data['vaccine'] = $vaccine->data()->get();
    	return view('vaccine/index', $data);
    }

    public function add(){
    	return view('vaccine/add');
    }

    public function edit($id){
    	$vaccine = new vaccine();
    	$data['vaccine'] = $vaccine->data('id', $id)->first();
    	return view('vaccine/edit', $data);
    }

    public function insert(Request $request){
    	$request->validate([
            'name'	 		=> 'required',
            'price' 		=> 'required|numeric|gt:0',
            'description'   => 'required',
            'image'		    => 'required|mimes:jpeg,jpg,png'
        ]);

    	$imageName = 'vaccine_'.time().'.'.$request->file('image')->extension();  
        $request->file('image')->move(public_path('images/vaccines'), $imageName);

        $input = $request->except(['_token']);
        $input['image'] = $imageName;
        $input['created_at'] = date('Y-m-d H:i:s');

        $vaccine = new vaccine();
		$vaccine->create($input);

    	return redirect('vaccine')->with('alert', show_alert('Vaccine created successfully', 'success'));
    }

    public function update(Request $request, $id){
    	$request->validate([
            'name'          => 'required',
            'price'         => 'required|numeric|gt:0',
            'description'   => 'required',
            'image'         => 'required|mimes:jpeg,jpg,png'
        ]);

    	$input = $request->except(['_token']);
        $input['updated_at'] = date('Y-m-d H:i:s');

    	if(isset($input['image'])){
    		$imageName = 'vaccine_'.time().'.'.$request->file('image')->extension();  
        	$request->file('image')->move(public_path('images/vaccines'), $imageName);
        	$input['image'] = $imageName;
    	}   
    	
        $vaccine = new vaccine();
		$vaccine->updates($input, $id);

    	return redirect('vaccine')->with('alert', show_alert('Vaccine updated successfully', 'success'));
    }

    public function delete($id){
    	$vaccine = new vaccine();
		$vaccine->deletes($id);

    	return redirect('vaccine')->with('alert', show_alert('Vaccine deleted successfully', 'success'));
    }
}
