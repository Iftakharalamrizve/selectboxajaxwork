<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class stateController extends Controller
{
    public function showwellcome(){
       $options = DB::table("states")->get();
        return view('welcome',compact('options'));
    }
    public function savestate(Request $request){
    	$data=[];
    	$data['name']=$request->name;
    	if(DB::table('states')->insert($data)){
    		        $states = DB::table("states")->get();
    				return response()->json(['message'=>'Data insert Success Fully','all_state'=>$states]);
    	}
    	else{
    		return response()->json(['message'=>'Data is not insert']);
    	}
    	
    }
}
