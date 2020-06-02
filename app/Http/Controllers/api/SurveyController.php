<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SurveyResource;
use App\Survey;

class SurveyController extends Controller
{
    public function create(Request $request){

        $survey = new Survey();
        $survey->kd_waris = Auth()->user()->id;
        $survey->nilai = $request->nilai;
        $survey->save();
        return response()->json([
            'status' => true,
            'message' => 'menilai',
            'data' => new SurveyResource($survey) 
        ], 200);
        
    }
}
