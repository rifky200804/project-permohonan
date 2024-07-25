@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.topnav', ['title' => $getTitle])
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Detail Pengajuan</h6>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="table-responsive p-0">
                    <form action="{{route('update',['menu'=>$getPath,'id'=>$pengajuan->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="judul" class="form-control-label">Judul</label>
                                    <input class="form-control" type="text" name="judul" id="judul" value="{{ $pengajuan->judul }}" @if($pengajuan->status != 'rejected to user') disabled @endif>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-control-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" @if($pengajuan->status != 'rejected to user') disabled @endif>{{ $pengajuan->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file" class="form-control-label">File</label>
                                    @if($pengajuan->status == 'rejected to user') 
                                    <input class="form-control" type="file" name="file" id="file"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                    @else
                                    <input class="form-control" type="text" name="file" id="file" value="{{ $pengajuan->file }}" disabled>
                                    @endif
                                    <a href="{{ asset('uploads/' . $pengajuan->file) }}" download>Download File</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">Status</label>
                                    <input class="form-control" type="text" name="status" id="status" value="{{ $pengajuan->status }}" disabled>
                                </div>
                            </div>  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="catatan_verifikator" class="form-control-label">Catatan Verifikator</label>
                                        <textarea class="form-control" name="catatan_verifikator" id="catatan_verifikator" rows="3" @if(auth()->user()->role != 'verifikator') disabled @endif>{{ $pengajuan->catatan_verifikator }}</textarea>
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="catatan_direktur" class="form-control-label">Catatan Direktur</label>
                                    <textarea class="form-control" name="catatan_direktur" id="catatan_direktur" rows="3" @if(auth()->user()->role != 'direktur') disabled @endif>{{ $pengajuan->catatan_direktur }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="{{ route('menu', $getPath) }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex justify-content-end">
                                    @if(auth()->user()->role == 'user' &&( $pengajuan->status == 'rejected to user'))
                                        <button type="submit" name="status" value="waiting to approve verifikator" class="btn btn-success">Send To Approve</button> &nbsp;
                                    @endif

                                    @if(auth()->user()->role == 'verifikator' &&( $pengajuan->status == 'waiting to approve verifikator' || $pengajuan->status == 'rejected to verifikator'))
                                        <button type="submit" name="status" value="rejected to user" class="btn btn-danger">Reject</button> &nbsp;
                                        <button type="submit" name="status" value="waiting to approve direktur" class="btn btn-success">Approve</button> &nbsp;
                                    @endif

                                    @if(auth()->user()->role == 'direktur' && $pengajuan->status == 'waiting to approve direktur')
                                        <button type="submit" name="status" value="rejected to user" class="btn btn-danger">Reject To User</button> &nbsp;
                                        <button type="submit" name="status" value="rejected to verifikator" class="btn btn-danger">Reject To Verifikator</button> &nbsp;
                                        <button type="submit" name="status" value="approve" class="btn btn-success">Approve</button> &nbsp;
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.footer')
@endsection
