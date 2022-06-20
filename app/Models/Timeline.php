<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timeline extends Model
{
    use HasFactory;
    protected $table = 'timeline';

    public function data($key = '', $value = ''){
        $tb = DB::table($this->table)
              ->selectRaw($this->table.".*, foto, nama")
              ->leftJoin('user', 'user.id', "=", $this->table.".user_id")
              ->orderBy($this->table.".id", 'desc');
        
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
