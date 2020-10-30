<?php

namespace App\Http\Controllers\api;

// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\WarisResource;
use App\Http\Resources\BerkasResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Waris;
use App\Data;
use Auth;
use Carbon\Carbon;
use Validator;


class WarisController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api_waris');
    }
    
   public function me(){
        $user = Auth::guard('api_waris')->user();

        return response()->json([
            'status'=> true,
            'message'=>"profile tampil",
            'data'=> new WarisResource($user)
        ], 200);
   }

   public function tracking(){
    $id = Auth::guard('api_waris')->user()->id;
    $data = Data::where('kd_waris', $id)->latest()->first();
            if ($data) {
                # code...
                return response()->json([
                    'status'=> true,
                    'message'=>"profile tampil",
                    'data'=> $data
                ], 200);
            }

            return response()->json([
                'status'=> false,
                'message'=>'gagal nyambung',
                'data'=> (object) []
            ], 401);
    }

    public function report(Request $request){
        $id = Auth::guard('api_waris')->user()->id;
        $data = Data::where('kd_waris',$id)->latest()->first();
        $rules =[
            'image_report'=>'image|mimes:jpeg,jpg,png|max:2048',
            'report'=>'required'
        ];
        $validasi = Validator::make($request->all(),$rules);
        if($validasi->fails()){
            return response()->json([
                "status"=>false,
                "massage"=>$validasi->errors()
            ], 400);
        }
        $data->report = $request->report;
        $data->image_report=$request->image_report;
        $data->date_report = Carbon::now($request->date_report)->format('Y-m-d H:i:s');
        $data->update();
        if ($data) {
            # code...
            return response()->json([
                'status'=> true,
                'message'=>'report berhasil'
            ], 200);
        }else {
            return response()->json([
                'status'=>false,
                'message'=>'gagal'
            ], 401);
        }

    }


   public function update(Request $request){
    $user = Auth::user();
    $rules = [
        'password' => 'required|min:8'
    ];
    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
        # code...
        return response()->json([
            'status'=> false,
            'message' => $validator->errors()
        ], 400);
    }
    $user ->password = bcrypt($request->password);
    $user->update();
    return response()->json([
        'status' => true,
        'message' => 'berhasil Update',
        'data'=> new WarisResource($user)
    ], 200);
   }


}
