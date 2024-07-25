@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.topnav', ['title' => 'Create Menu'])
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Create Menu</h6>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="table-responsive p-0">
                    <form action="{{route('menu.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('name') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Path</label> 
                                    / <input class="form-control" type="text" name="path"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                        @error('path') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Role Akses</label> 
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="role_akses[]" id="direktur" value="direktur">
                                        <label for="direktur">Direktur</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="role_akses[]" id="verifikator" value="verifikator"> 
                                        <label for="verifikator">Verifikator</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="role_akses[]" id="user" value="user"> 
                                        <label for="user">User</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
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

@push('js')
    <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>
@endpush
