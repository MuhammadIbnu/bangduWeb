<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\Waris;
use App\Petugas;
class ReportController extends Controller
{
    //

    public function index(Request $request){
        $report = Data::whereNotNull('report')->paginate(20);
        $filterKeyword = $request->get('keyword');
        $report = Data::whereHas('waris',function($query) use($filterKeyword){
            $query->where('nama','like',"%$filterKeyword")->whereNotNull('report');
        })->paginate(20);
        return view('report.index',compact('report'));
    }

    public function show(Request $request,$id){
        $show = Data::findOrfail($id);
        return view('show',compact('show'));
    }
}
