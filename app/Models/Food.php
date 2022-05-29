<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{   
    protected $table = 'food';

    public function data($key = '', $value = ''){
        $tb = DB::table($this->table)->orderBy($this->table.".id", "desc");
        
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
        return DB::table($this->table)->insert($data);
    }

    public function updates($data, $id){
        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function deletes($id){
        return DB::table($this->table)->where('id', $id)->delete();
    }
}
