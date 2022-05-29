<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{   
    protected $table = 'transaction';

    public function data($key = '', $value = ''){
        $tb = DB::table($this->table)
              ->selectRaw('transaction.*, user.*, transaction.id as transaction_id,
                           driver.nama as driver_name, driver.no_hp as driver_phone, 
                           driver.foto as driver_photo')
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

        $tb->join('user', $this->table.'.user_id', '=', 'user.id')
           ->leftJoin('user as driver', 'driver.id', '=', 'transaction.driver_id')
           ->orderBy($this->table.'.id', 'desc');

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
