<!DOCTYPE html>
<html>
    <head>
        @include('parts.meta')
        @include('assets.master-style')
        @stack('styles')
    </head>
    <body class="bg-white d-flex flex-column min-vh-100">

        <div id="head" class="container-fluid">
            <div class="row bg-primary p-3">
                <div class="col-auto d-flex align-items-center text-white">
                    {{ cache('first_name') . ' ' . cache('last_name') }}
                </div>
                <a href="{{ route('authors.list') }}" class="header-buttons col-auto ms-auto">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
                <a href="{{ route('logout') }}" class="header-buttons col-auto ms-3">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <div id="main" class="container-fluid d-flex flex-column flex-grow-1 py-3">
            @yield('content')
        </div>

        @include('assets.master-js')
        @stack('scripts')
    </body>
</html>
