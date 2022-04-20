<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{   
    public function data($key = '', $value = ''){
        $tb = DB::table('patients');
        
        if($key != ''){
            if(is_array($key)){
                foreach ($key as $k => $v) {
                     $tb->where($k, $v);
                }
               
            }else{
                $tb->where($key, $value);
            }
        }

        $tb->join('vaccines', 'vaccines.id', '=', 'patients.vaccine_id')
           ->select('patients.*', 'vaccines.name AS vaccine_name');
        return $tb;
    }

    public function create($data){
        return DB::table('patients')->insert($data);
    }

    public function updates($data, $id){
        return DB::table('patients')->where('id', $id)->update($data);
    }

    public function deletes($id){
        return DB::table('patients')->where('id', $id)->delete();
    }
}
