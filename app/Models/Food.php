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

    public function getFoodListForPage(){
        $recommendFoodIds = [];
        $foodRecommend = DB::table('transaction_detail')
                     ->selectRaw('food.id, food.*, SUM(qty) AS total_sell')
                     ->join('food', 'food.id', '=', 'transaction_detail.food_id')
                     ->join('transaction', 'transaction.id', '=', 'transaction_detail.transaction_id')
                     ->where('status', '!=', 'pending')
                     ->where('status', '!=', 'need_confirmation')
                     ->where('status', '!=', 'deny')
                     ->groupBy('food.id')
                     ->orderBy('total_sell', 'desc')
                     ->limit(3)->get();

        foreach($foodRecommend as $row){
            $recommendFoodIds[] = $row->id;
        }

        $discountFoodIds = $foodDiscount = [];
        $discount = DB::table($this->table)->whereNotIn('id', $recommendFoodIds)->where('price_actual', '!=', 'price')->get();

        foreach($discount as $row){
            $foodDiscount[$row->id] = $row;
            $discountFoodIds[] = $row->id;
        }

        $foodCommon = DB::table($this->table)->whereNotIn('id', $discountFoodIds)->whereNotIn('id', $recommendFoodIds)->get();

        return [
            'recommend' => $foodRecommend,
            'discount'  => $foodDiscount,
            'common'    => $foodCommon
        ];
    }
}
