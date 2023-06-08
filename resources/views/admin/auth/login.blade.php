@extends('admin.auth.layouts.master')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="col-lg-12">
                            @if(session('success'))
                            <div class="alert alert-success text-center">
                                <span>{{ session('success') }}</span>
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger text-center">
                                <span> {{ session('error') }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="brand-logo">
                            <h1><b>Login</b></h1>
                        </div>
                        <form class="pt-3" method="POST" action="{{ route('loginaction') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
                                @error('email')
                                <span>
                                    <div class="text-danger">{{ $message }}</div>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                                @error('password')
                                <span>
                                    <div class="text-danger">{{ $message }}</div>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block tex btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                            </div>
                            {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" class="form-check-input">
                          Keep me signed in
                        </label>
                      </div>
                      <a href="#" class="auth-link text-black">Forgot password?</a>
                    </div> --}}
                            {{-- <div class="text-center mt-4 font-weight-light">
                      Don't have an account? <a href="{{route('register')}}" class="text-primary">Create</a>
                    </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
@endsection
