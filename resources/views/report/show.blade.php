@extends('layouts.template')

@section('title')
    Data Pengajuan
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="{{route('report.index')}}" class="btn btn-success">Back</a>
                </div>
                <div class="box-body">
                   <table class="table table-bordered">
                       <tr>
                           <td>nik ahli waris</td>
                           <td>:</td>
                           <td>{{$report->waris->nik}}</td>
                       </tr>
                        <tr>
                            <td>kk ahlis waris</td>
                            <td>:</td>
                            <td>{{$report->waris->kk}}</td>
                        </tr>
                        <tr>
                            <td>nama ahli waris</td>
                            <td>:</td>
                            <td>{{$report->waris->nama}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{$report->waris->jk}}</td>
                        </tr>
                        <tr>
                            <td>Berkas</td>
                            <td>:</td>
                            <td>
                                <div class="row">
                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <a href="{{asset($report->ktp_meninggal)}}" target="_blank">
                                                <img src="{{asset($report->ktp_meninggal)}}" alt="Lights" style="width:100%">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <a href="{{asset($report->kk_meninggal)}}" target="_blank">
                                                    <img src="{{asset($report->kk_meninggal)}}" alt="Nature" style="width:100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <a href="{{asset($report->jamkesmas)}}" target="_blank">
                                                    <img src="{{asset($report->jamkesmas)}}" alt="Fjords" style="width:100%">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                            <a href="{{asset($report->ktp_waris)}}" target="_blank">
                                                <img src="{{asset($report->ktp_waris)}}" alt="Fjords" style="width:100%">
                                            </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                            <a href="{{asset($report->kk_waris)}}" target="_blank">
                                                <img src="{{asset($report->kk_waris)}}" alt="Lights" style="width:100%">
                                            </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <a href="{{asset($report->akta_kematian)}}" target="_blank">
                                                    <img src="{{asset($report->akta_kematian)}}" alt="Nature" style="width:100%">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <a href="{{asset($report->pakta_waris)}}" target="_blank">
                                                    <img src="{{asset($report->pakta_waris)}}" alt="Nature" style="width:100%">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <a href="{{asset($report->pernyataan_ahli_waris)}}" target="_blank">
                                                    <img src="{{asset($report->pernyataan_ahli_waris)}}" alt="Nature" style="width:100%">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <a href="{{asset($report->buku_tabungan)}}" target="_blank">
                                                    <img src="{{asset($report->buku_tabungan)}}" alt="Nature" style="width:100%">
                                                </a>
                                            </div>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>pengecekan Data Masuk</td>
                            <td>:</td>
                            <td>@if ($report->confirmed_I === true)<button type="button" class="btn btn-primary"> Sukses </button> 
                                @elseif($report->confirmed_I === null)<button type="button" class="btn btn-warning"> sedang divalidasi </button>
                                @else <button type="button" class="btn btn-danger"> gagal </button>  
                                @endif</td>
                        </tr>
                        <tr>
                            <td>Badan Keuangan Daerah</td>
                            <td>:</td>
                            <td>@if ($report->confirmed_II == true)<button type="button" class="btn btn-primary"> Sukses </button>
                                @elseif($report->confirmed_II === null)<button type="button" class="btn btn-warning"> sedang divalidasi </button> 
                                @else <button type="button" class="btn btn-danger"> gagal </button>  
                                @endif</td>
                        </tr>
                        
                   </table>
                </div>
            </div>
        </div>
    </div>
@endsection