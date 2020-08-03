@extends('layouts.template')
@section('title')
    tambah data Dinas Kesehatan
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"> 
                      @include('alert.error')
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{route('dinkes.store')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">UserName</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="minimal 6 karakter tanpa spasi" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,11}$" class="form-control" id="username" name="username" value="{{old('username')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama Petugas</label>
                                <div class="col-sm-10">
                                    <input placeholder="Tulis Nama"ype="text" maxlength="50" placeholder="Maksimal karakter adalah 50" class="form-control" id="nama" name="nama" value="{{old('nama')}}">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection