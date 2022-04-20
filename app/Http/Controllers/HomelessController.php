<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homeless;

class HomelessController extends Controller
{
    public function index(){
        $homeless = new Homeless();
        $data['homeless'] = $homeless->data()->get();
        return view('homeless/index', $data);
    }

    public function add(){
        return view('homeless/add');
    }

    public function edit($id){
        $homeless = new Vaccine();

        $data['patient'] = $patient->data('patients.id', $id)->first();
        $data['vaccine'] = $homeless->data('id', $data['patient']->vaccine_id)->first();
        return view('patient/edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'              => 'required',
            'subdis_id'         => 'required',
            'location_detail'   => 'required',
            'total_count'       => 'required',
            'characteristic'    => 'required',
            'photo'  => 'required|mimes:jpeg,jpg,png'
        ]);
        $input = $request->except(['_token']);
        $input['created_at'] = date('Y-m-d H:i:s');

        if(isset($input['image_ktp'])){
            $imageName = 'homeless_'.time().'.'.$request->file('photo')->extension();  
            $request->file('photo')->move(public_path('images/homeless'), $imageName);
            $input['photo'] = $imageName;
        }   
        
        $homeless = new Homeless();
        $homeless->updates($input, $id);

        return redirect('patient/list')->with('alert', show_alert('Data tunawisma berhasil diubah', 'success'));
    }

    public function insert(Request $request){
        $request->validate([
            'name'              => 'required',
            'subdis_id'         => 'required',
            'location_detail'   => 'required',
            'total_count'       => 'required',
            'characteristic'    => 'required',
            'photo'  => 'required|mimes:jpeg,jpg,png'
        ]);

        $imageName = 'homeless_'.time().'.'.$request->file('photo')->extension();  
        $request->file('photo')->move(public_path('images/homeless'), $imageName);

        $input = $request->except(['_token']);
        $input['photo'] = $imageName;
        $input['created_at'] = date('Y-m-d H:i:s');

        $homeless = new Homeless();
        $homeless->create($input);

        return redirect('homeless')->with('alert', show_alert('Data tunawisma berhasil ditambahkan', 'success'));    
    }

    public function delete($id){
        $homeless = new Homeless();
        $homeless->deletes($id);

        return redirect('homeless')->with('alert', show_alert('Data tunawisma berhasil dihapus', 'success'));
    }
}
