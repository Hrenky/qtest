<!DOCTYPE html>
<html>
    <head>
        @include('parts.meta')
        @include('assets.master-style')
        @stack('styles')
    </head>
    <body class="bg-default">

        <!-- Page content -->
        <div class="main-content">
            <div class="container">
                <div class="row vh-100 align-items-center justify-content-center">
                    <div class="col-lg-5 col-md-7">
                        <div class="card bg-white border-1 mb-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-uppercase text-lg-center mb-4">
                                    <small>Sign in</small>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('login') }}" method="post" role="form">
                                    @csrf
                                    <div class="mb-3">
                                        <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" type="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" type="password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('assets.master-js')
        @stack('scripts')
    </body>
</html>
