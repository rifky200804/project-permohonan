
@php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    $menusDb = DB::table('menus')->get();

    $user = Auth::user();
    $role = $user->role;
    $menus = [];
    foreach ($menusDb as $key => $value) {
        $accessMenu = explode(',', $value->access_permission);
        if (in_array($role,$accessMenu)) {
            $menus[] = $value;
        }
    }
@endphp
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        {{-- <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i> --}}
        <a class="navbar-brand m-0" href="{{ route('dashboard') }}"
            target="_blank">
            <img src="{{asset('admin/img/logo-ct-dark.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Request Submission</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 {{ Route::currentRouteName() == 'dashboard' ? 'text-primary' : 'text-dark' }}  text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @if ($role == "super admin")
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 {{ Route::currentRouteName() == 'users.index' ? 'text-primary' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'menu.index' ? 'active' : '' }}" href="{{ route('menu.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 {{ Route::currentRouteName() == 'menu.index' ? 'text-primary' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Menu</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'hak-akses.index' ? 'active' : '' }}" href="{{ route('hak-akses.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 {{ Route::currentRouteName() == 'hak-akses.index' ? 'text-primary' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Hak Akses Permission</span>
                </a>
            </li>
            @endif

            {{-- this looping --}}
            @foreach($menus as $menu => $value)
                <li class="nav-item">
                    <a class="nav-link {{ isset(Route::getCurrentRoute()->parameters["menu"]) ?  Route::getCurrentRoute()->parameters["menu"] == $value->path ? 'active' : '' : '' }}" href="{{ route('menu',$value->path) }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 {{ isset(Route::getCurrentRoute()->parameters["menu"]) ?  Route::getCurrentRoute()->parameters["menu"] == $value->path ? 'text-primary' : 'text-dark' : 'text-dark' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{$value->name}}</span>
                    </a>
                </li>
            @endforeach
            
        </ul>
    </div>
</aside>
