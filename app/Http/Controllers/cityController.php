<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class cityController extends Controller
{
    public function saveciti(Request $request){
    	$data=[];
    	$data['state_id']=$request->state_id;
    	$data['name']=$request->name;
    	if(DB::table('cities')->insert($data)){
    		return response()->json('Data insert success');
    	}
    	else{
    		return response()->json('Sorry Data insert is not success');
    	}

    }

    public function selectoptionbyid(Request $request){
    	$id=$request->state_id;
    	$selectedoption=DB::table('cities')->where('state_id',$id)->get();
    	if(isset($selectedoption)){
    		return response()->json($selectedoption);
    	}
    	else{
    		return response()->json("hello");
    	}
    	
    }
}
