@extends('layouts.template')

@section('title')
    Data Laporan Masyarakat
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    @if (Request::get('keyword'))
                        <a href="{{route('report.index')}}" class="btn btn-success">Back</a>
                    @endif
                    <form action="{{route('report.index')}}" method="get">
                        <div class="fore-group">
                            <label for="keyword" class="col-sm-2 control-label">Search By name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
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
                                <th>Nama pengaju</th>
                                <th>Pegawai Disdukcapil</th>
                                <th>Pegawai Bakeuda</th>
                                <th>Laporan</th>
                                <th>Tanggal pengajuan</th>
                                <th>Tanggal Lapor</th>
                                <th width="30%">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $row)
                                <tr>
                                    <td>{{$loop->iteration + ($report->perPage() *($report->currentPage()-1))}} </td>
                                    <td>{{$row->waris->nama}}</td>
                                    <td>@if ($row->petugas == null)
                                    belum Diperiksa    
                                    @else
                                        {{$row->petugas->nama}}
                                    @endif</td>
                                    <td>@if ($row->bakuda == null)
                                        belum Diperiksa    
                                        @else
                                            {{$row->bakuda->nama}}
                                        @endif</td>
                                    <td>{{$row->report}}</td>
                                    <td>{{$row->created_at->format('Y-m-d H:i:s')}}</td>
                                    <td>{{$row->date_report}}</td>
                                    <td>
                                        <a href="{{route('report.show',[$row->kd_berkas])}}" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$report->appends(Request::All())->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection