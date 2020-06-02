@extends('layouts.template')

@section('title')
   Report Data 
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    @if (Request::get('keyword'))
                        <a href="{{route('aktivitas.index')}}" class="btn btn-success">Back</a>
                    @endif
                    <form action="{{route('aktivitas.index')}}" method="get">
                        <div class="fore-group">
                            <label for="keyword" class="col-sm-2 control-label">Search By name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                        <a href="cetak_pdf" class="btn btn-primary" target="_blank">CETAK PDF</a>
                    </form>
                   
                </div>
                <div class="box-body">
                    @if (Request::get('keyword'))
                        <div class="alert alert-success alert-black">hasil pencarian dangan keyword: <b>{{Request::get('keyword')}}</b></div>
                    @endif
                        @include('alert.success')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nik</th>
                                <th>KK</th>
                                <th>Nama</th>
                                <th>Tanggal Pengesahan</th>
                                <th>Status berkas</th>
                                <th width="30%">Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_data as $row)
                                <tr>
                                    <td>{{$loop->iteration + ($report_data->perPage() *($report_data->currentPage()-1))}} </td>
                                    <td>{{$row->waris->nik}}</td>
                                    <td>{{$row->waris->kk}}</td>
                                    <td>{{$row->waris->nama}}</td>
                                    <td>{{$row->updated_at->format('d/m/Y')}}</td>
                                    <td>@if ($row->confirmed_III == 1)<button type="button" class="btn btn-primary">sukses</button>   
                                    @endif</td>
                                    <td>{{$row->petugas->nama}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$report_data->appends(Request::All())->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection