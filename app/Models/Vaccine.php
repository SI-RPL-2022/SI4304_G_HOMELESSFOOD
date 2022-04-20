<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{   
    public function data($key = '', $value = ''){
        $tb = DB::table('vaccines');
        
        if($key != ''){
            if(is_array($key)){
                foreach ($key as $k => $v) {
                     $tb->where($k, $v);
                }
               
            }else{
                $tb->where($key, $value);
            }
        }

        return $tb;
    }

    public function create($data){
        return DB::table('vaccines')->insert($data);
    }

    public function updates($data, $id){
        return DB::table('vaccines')->where('id', $id)->update($data);
    }

    public function deletes($id){
        return DB::table('vaccines')->where('id', $id)->delete();
    }
}
