<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Data;
use App\Waris;

class BerkasController extends Controller
{
    //
    public function index()
    {
        //
        $report_data = Data::where('confirmed_III','1')->orderBy('updated_at','DESC')->paginate(20);
        return view('report_data.index',compact('report_data'));
    }

    public function cetak_pdf(){
        $report_data = Data::where('confirmed_III','1')->orderBy('updated_at','DESC')->paginate(20);
        $pdf =PDF::loadview('report_data.data_pdf',compact('report_data'));
        return $pdf->stream();
    }
    
}
