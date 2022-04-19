<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccine;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index(){
        $vaccine = new Vaccine();
        $data['vaccine'] = $vaccine->data()->get();
        return view('patient/index', $data);
    }

    public function edit($id){
        $patient = new Patient();
        $vaccine = new Vaccine();

        $data['patient'] = $patient->data('patients.id', $id)->first();
        $data['vaccine'] = $vaccine->data('id', $data['patient']->vaccine_id)->first();
        return view('patient/edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'    => 'required',
            'nik'     => 'required',
            'alamat'  => 'required',
            'no_hp'   => 'required',
        ]);

        $input = $request->except(['_token']);
        $input['updated_at'] = date('Y-m-d H:i:s');

        if(isset($input['image_ktp'])){
            $imageName = 'ktp_'.time().'.'.$request->file('image_ktp')->extension();  
            $request->file('image_ktp')->move(public_path('images/ktp'), $imageName);
            $input['image_ktp'] = $imageName;
        }   
        
        $patient = new patient();
        $patient->updates($input, $id);

        return redirect('patient/list')->with('alert', show_alert('Patient updated successfully', 'success'));
    }

    public function list(){
        $patient = new Patient();
        $data['patient'] = $patient->data()->get();
        return view('patient/list', $data);
    }

    public function register($vaccine_id){
        $vaccine = new Vaccine();
        $data['vaccine'] = $vaccine->data('id', $vaccine_id)->first();
        return view('patient/register', $data);
    }

    public function insert(Request $request){
        $request->validate([
            'name'    => 'required',
            'nik'     => 'required',
            'alamat'  => 'required',
            'no_hp'   => 'required',
        ]);

        $imageName = 'ktp_'.time().'.'.$request->file('image_ktp')->extension();  
        $request->file('image_ktp')->move(public_path('images/ktp'), $imageName);

        $input = $request->except(['_token']);
        $input['image_ktp'] = $imageName;
        $input['created_at'] = date('Y-m-d H:i:s');

        $patient = new Patient();
        $patient->create($input);

        return redirect('patient/list')->with('alert', show_alert('Patient registered successfullty', 'success'));    
    }

    public function delete($id){
        $patient = new patient();
        $patient->deletes($id);

        return redirect('patient/list')->with('alert', show_alert('Patient deleted successfully', 'success'));
    }
}
