@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.topnav', ['title' => $getTitle])
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Create {{$getTitle}}</h6>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="table-responsive p-0">
                    <form action="{{route('store',$getPath)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="judul" class="form-control-label">Judul</label>
                                    <input class="form-control" type="text" name="judul" id="judul" value="{{old('judul')}}"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('judul') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-control-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"
                                        onfocus="focused(this)" onfocusout="defocused(this)">{{old('deskripsi')}}</textarea>
                                    @error('deskripsi') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file" class="form-control-label">File</label>
                                    <input class="form-control" type="file" name="file" id="file"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('file') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="{{route('menu', $getPath)}}" class="btn btn-danger">
                                        Cancel
                                    </a> &nbsp;
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
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

