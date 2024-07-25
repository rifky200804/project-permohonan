@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.topnav', ['title' => 'Edit User'])
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Edit User</h6>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="table-responsive p-0">
                    <form action="{{route('users.update', $user->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('name') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Password</label>
                                    <input class="form-control" type="password" name="password" id="password"
                                        onfocus="focused(this)" onfocusout="defocused(this)" value="{{$user->password}}" disabled>
                                    <input type="hidden" name="password" value="{{$user->password}}">
                                    @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role" class="form-control-label">Role</label>
                                   <select name="role" id="role" class="form-control">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="verifikator" {{ $user->role == 'verifikator' ? 'selected' : '' }}>Verifikator</option>
                                        <option value="direktur" {{ $user->role == 'direktur' ? 'selected' : '' }}>Direktur</option>
                                        <option value="super admin" {{ $user->role == 'super admin' ? 'selected' : '' }}>Super Admin</option>
                                   </select>
                                   @error('role') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="{{route('users.index')}}" class="btn btn-danger">
                                        Cancel
                                   </a> &nbsp;
                                   <button type="submit" class="btn btn-primary">
                                        Update
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