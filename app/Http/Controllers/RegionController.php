<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class RegionController extends Controller
{
	public function getDis(Request $request){
		$cities_id = $request->input('cities_id');
		$tb = DB::table('districts');
		$tb->where('city_id', $cities_id)
		   ->orderBy('dis_name');
		$district = $tb->get();

		return response()->json([
			'status' => true,
			'data' => $district
		], 200);
	}

	public function getSubdis(Request $request){
		$cities_id = $request->input('dis_id');
		$tb = DB::table('subdistricts');
		$tb->where('dis_id', $cities_id)
		   ->orderBy('subdis_name');
		$subdistrict = $tb->get();

		return response()->json([
			'status' => true,
			'data' => $subdistrict
		], 200);
	}
}