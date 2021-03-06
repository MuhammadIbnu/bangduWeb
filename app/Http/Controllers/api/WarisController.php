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
use Storage;
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

    public function finish(Request $request){
        $id = Auth::guard('api_waris')->user()->id;
        $data = Data::where('kd_waris',$id)->latest()->first();
        $data->status_data = $request->status_data;
        $data->update();
        // $optionBuilder = new OptionsBuilder();
        // $optionBuilder->setTimeToLive(60*20);
        
        // $notificationBuilder = new PayloadNotificationBuilder('Bantuan Uang Duka #JawabanLapor');
        // $notificationBuilder->setBody('ayo lihat ada kabar baik untuk kamu!')
        //             ->setSound('default');
        // $dataBuilder = new PayloadDataBuilder();
        // $dataBuilder->addData(['a_data' => 'my_data']);

        // $option = $optionBuilder->build();
        // $notification = $notificationBuilder->build();
        // $_data = $dataBuilder->build();
        // $token = $data->waris->fcm_token;
        // $downstreamResponse = FCM::sendTo($token, $option, $notification, $_data);

        return response()->json([
            'status'=>true,
            'message' => 'berhasil',
        ], 200);
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
        $data->date_report = Carbon::now($request->date_report)->format('Y-m-d H:i:s');
        if ($request->file('image_report')->isValid()) {
            # code...
            $gambar_berkas = $request->file('image_report');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "image_report".date('YmdHis').".".$extention;
            $file_path = "image_report/" . $namaFoto;
            Storage::disk('s3')->put($file_path, file_get_contents($gambar_berkas));
            $data->image_report = Storage::disk('s3')->url($file_path, $namaFoto);
        }
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
