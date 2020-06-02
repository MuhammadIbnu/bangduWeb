<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BerkasResource;
use App\Data;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Auth;
use Illuminate\Support\Str;

class BerkasController extends Controller
{
    public function index(){
        $data = Data::get();
        return BerkasResource::collection($data);
    }
    
    public function berkas(Request $request){

        $rules = [
            'ktp_meninggal'=>'required|image|mimes:jpeg,jpg,png|max:2048',
            'kk_meninggal'=>'required|image|mimes:jpeg,jpg,png|max:2048',
            'jamkesmas'=>'required|image|mimes:jpeg,jpg,png|max:2048',
            'ktp_waris'=>'required|image|mimes:jpeg,jpg,png|max:2048',
            'kk_waris'=>'required|image|mimes:jpeg,jpg,png|max:2048',
            'akta_kematian'=>'required|image|mimes:jpeg,jpg,png|max:2048',
            'pernyataan_ahli_waris'=>'required|image|mimes:jpeg,jpg,png|max:2048',
            'pakta_waris'=>'required|image|mimes:jpeg,jpg,png|max:2048',
        ];

        $validasi = Validator::make($request->all(), $rules);

        if($validasi->fails()) {
            return response()
            ->json([
                "status"=>FALSE,
                "msg"=>$validasi->errors()
                ],400);
        }
        $data = new Data();
        $data->kd_waris = Auth()->user()->id;

        if ($request->file('ktp_meninggal')->isValid()) {
            # code...
            $gambar_berkas = $request->file('ktp_meninggal');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "ktp_meninggal_".date('YmdHis').".".$extention;
            $upload_path='public/uploads/berkas';
            $request->file('ktp_meninggal')->move($upload_path,$namaFoto);
            $data->ktp_meninggal=$namaFoto;
        }

        if ($request->file('kk_meninggal')->isValid()) {
            # code...
            $gambar_berkas = $request->file('kk_meninggal');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "kk_meninggal_".date('YmdHis').".".$extention;
            $upload_path='public/uploads/berkas';
            $request->file('kk_meninggal')->move($upload_path,$namaFoto);
            $data->kk_meninggal=$namaFoto;
        }

        if ($request->file('jamkesmas')->isValid()) {
            # code...
            $gambar_berkas = $request->file('jamkesmas');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "jamkesmas_".date('YmdHis').".".$extention;
            $upload_path='public/uploads/berkas';
            $request->file('jamkesmas')->move($upload_path,$namaFoto);
            $data->jamkesmas=$namaFoto;
        }

        if ($request->file('ktp_waris')->isValid()) {
            # code...
            $gambar_berkas = $request->file('ktp_waris');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "ktp_waris_".date('YmdHis').".".$extention;
            $upload_path='public/uploads/berkas';
            $request->file('ktp_waris')->move($upload_path,$namaFoto);
            $data->ktp_waris=$namaFoto;
        }

        if ($request->file('kk_waris')->isValid()) {
            # code...
            $gambar_berkas = $request->file('kk_waris');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "kk_waris_".date('YmdHis').".".$extention;
            $upload_path='public/uploads/berkas';
            $request->file('kk_waris')->move($upload_path,$namaFoto);
            $data->kk_waris=$namaFoto;
        }

        if ($request->file('akta_kematian')->isValid()) {
            # code...
            $gambar_berkas = $request->file('akta_kematian');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "akta_kematian_".date('YmdHis').".".$extention;
            $upload_path='public/uploads/berkas';
            $request->file('akta_kematian')->move($upload_path,$namaFoto);
            $data->akta_kematian=$namaFoto;
        }

        if ($request->file('pernyataan_ahli_waris')->isValid()) {
            # code...
            $gambar_berkas = $request->file('pernyataan_ahli_waris');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "pernyataan_ahli_waris_".date('YmdHis').".".$extention;
            $upload_path='public/uploads/berkas';
            $request->file('pernyataan_ahli_waris')->move($upload_path,$namaFoto);
            $data->pernyataan_ahli_waris=$namaFoto;
        }

        if ($request->file('pakta_waris')->isValid()) {
            # code...
            $gambar_berkas = $request->file('pakta_waris');
            $extention = $gambar_berkas->getClientOriginalExtension();
            $namaFoto = "pakta_waris_waris_".date('YmdHis').".".$extention;
            $upload_path='public/uploads/berkas';
            $request->file('pakta_waris')->move($upload_path,$namaFoto);
            $data->pakta_waris=$namaFoto;
        }
        $data->save();
        return response()->json([
            'status'=>true,
            'message'=>'berhasil',
            'data'=> new BerkasResource($data)
        ], 200);
     }

     public function confirmed_I(Request $request, $data){
       
        $data = Data::where('kd_berkas', $data)->first();
        $data->kd_petugas = Auth::user()->id;
        $data->confirmed_I = $request->confirmed_I;
        $data->keterangan = $request->keterangan;
        $data->update();
            # code...
            return response()->json([
                'status' => true,
                'message' => 'acc',
                'data' => new BerkasResource($data)
            ],200);
     }

     public function confirmed_II(Request $request, $data){
         $data = Data::where('kd_berkas', $data)->first();
         $data->kd_dinkes =  Auth::user()->id;
         $data->confirmed_II = $request->confirmed_II;
         $data->keterangan_II = $request->keterangan_II;
         $data->update();

         return response()->json([
             'status'=>true,
             'message' => 'ok',
             'data' => new BerkasResource($data)
         ], 200);
     }

     public function confirmed_III(Request $request, $data){
        $data = Data::where('kd_berkas', $data)->first();
        $data->kd_petugas = Auth::user()->id;
        $data->confirmed_III = $request->confirmed_III;
        $data->keterangan_III = $request->keterangan_III;
        $data->update();
            # code...
            return response()->json([
                'status' => true,
                'message' => 'acc',
                'data' => new BerkasResource($data)
            ],200);        
     }

     #melihat data baru

     public function dataMasuk(){
        $data = Data::where('confirmed_I')->get();
        return response()->json([
            'status'=>true,
            'message'=> 'data masuk',
            'data'=> BerkasResource::collection($data)
        ], 200);

        return response()->json([
            'status'=> false,
            'message'=>'gagal nyambung',
            'data'=> (object) []
        ], 401);
     }
     #melihat data confirmed I nilai true
     public function dataConfirmedI(){
        $data = Data::where('confirmed_I','1')->get();
        return response()->json([
            'status'=>true,
            'message'=> 'data tampil',
            'data'=> BerkasResource::collection($data)
        ], 200);

        return response()->json([
            'status'=> false,
            'message'=>'gagal nyambung',
            'data'=> (object) []
        ], 401);
     }

     #melihat data confirmed II nilai true
     public function dataConfirmedII(){
         $data = Data::where('confirmed_II','1')->get();
         return response()->json([
             'status'=>true,
             'message'=>'data tampil',
             'data'=> BerkasResource::collection($data)
         ], 200, $headers);

         return response()->json([
            'status'=> false,
            'message'=>'gagal nyambung',
            'data'=> (object) []
        ], 401);
     }

     #melihat data confrimed III nilai true
     public function dataConfirmedIII(){
        $data = Data::where('confirmed_III','1')->get();
        return response()->json([
            'status'=>true,
            'message'=>'data tampil',
            'data'=> BerkasResource::collection($data)
        ], 200, $headers);

        return response()->json([
           'status'=> false,
           'message'=>'gagal nyambung',
           'data'=> (object) []
       ], 401);
    }

}

