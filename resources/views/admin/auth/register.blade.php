@extends('admin.auth.layouts.master')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <h1><b>Register</b></h1>
                        </div>
                        {{-- <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6> --}}
                        <form method="POST" action="{{ route('registeraction') }}" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="exampleInputUsername1" placeholder="Username" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" id="exampleInputUsername1" placeholder="phone" name="phone" value="{{ old('phone') }}" maxlength="10" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="file" name="images" class="file-upload-default" @error('images') is-invalid @enderror>
                                <div class="input-group col-xs-12">
                                    <input type="file " class="form-control file-upload-info" placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" @error('password_confirmation') is-invalid @enderror id="exampleInputPassword1" placeholder="Confirm Password" name="password_confirmation" required>
                                @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="terms" value="1" required>
                      I agree to all Terms & Conditions
                    </label>
                    @error('terms')
                      <div class="invalid-feedback">{{ $message }}
                    </div>
                    @enderror
                </div>
            </div> --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
            </div>
            <div class="text-center mt-4 font-weight-light">
                Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection
