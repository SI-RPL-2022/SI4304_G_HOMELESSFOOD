<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homeless;
use Illuminate\Support\Facades\DB;

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
        $homeless = new Homeless();

        $query = $homeless->data('homeless.id', $id);
        if($query->count() == 0){
            return redirect('homeless')->with('alert', show_alert('Data tunawisma tidak ditemukan', 'danger'));
        }

        $homelessData = $query->first();
        $cityId = '161';
        $sub = DB::table('subdistricts')
                ->where('subdis_id', $homelessData->subdis_id)
                ->first();

        $data = [
            'homeless' => $query->first(),
            'disId' => $sub->dis_id,
            'subdis'   => DB::table('subdistricts')->where('dis_id', $sub->dis_id)->get(),
            'dis'      => DB::table('districts')->where('city_id', $cityId)->get()
        ];
        return view('homeless/edit', $data);
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
            $imageName = 'homeless_'.time().'.'.$request->file('photo')->extension();  
            $request->file('photo')->move(public_path('images/homeless'), $imageName);
            $input['photo'] = $imageName;
        }   
        
        $homeless = new Homeless();
        $homeless->updates($input, $id);

        return redirect('homeless')->with('alert', show_alert('Data tunawisma berhasil diubah', 'success'));
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

    public function getById(Request $request){
        $homeless = new Homeless();
        $homeless_id = $request->homeless_id;
        
        return response()->json([
            'status' => true,
            'data' => $homeless->data('homeless.id', $homeless_id)->first()
        ], 200);
    }
}
