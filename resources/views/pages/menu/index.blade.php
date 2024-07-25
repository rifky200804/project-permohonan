@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.topnav', ['title' => 'Menu'])
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Menu</h6>
                <a class="btn btn-primary btn-sm" href="{{route('menu.create')}}">Tambah Menu Pengajuan</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Path
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        @foreach ($menus as $menu => $value)
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $value->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $value->path }}</p>
                                    </td>
                                    <td class="align-middle text-end">
                                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                            @if ($value->path != 'verifikasi' && $value->path != 'approval')
                                                
                                                
                                                <button type="button" class="btn btn-danger text-sm font-weight-bold mb-0 ps-2"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{$value->id}}">
                                                    Delete
                                                </button>
                                                {{-- modal --}}
                                                <div class="modal fade" id="deleteModal{{$value->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Do You Will Delete this data {{$value->name}}?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn bg-gradient-secondary mb-0 ps-2"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                        <a href="{{route('menu.delete',$value->id)}}" class="btn btn-danger text-sm font-weight-bold mb-0 ps-2">Delete</a>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- end modal --}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.footer')
@endsection

@push('js')
    <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>
@endpush
