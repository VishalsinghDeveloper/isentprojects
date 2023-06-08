@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<section>
    <div>
        <div class="row">
            <div class="col-lg-12">
                @if(session('message'))
                <div class="alert alert-success text-center">
                    <span>{{ session('message') }}</span>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger text-center">
                    <span> {{ session('error') }}</span>
                </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="card-title  ">Profile</h2>
                        </div>
                        <form action="{{ route('updateimage',$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(!empty($user->images) && File::exists(public_path($user->images)))
                            <img src="{{ asset($user->images) }}" class="rounded-circle img-fluid" style="width: 150px;" id="viewimages">
                            @else
                            <img src="{{ asset('uploads/noimg.webp') }}" class="rounded-circle img-fluid" style="width: 150px;" id="viewimages">
                            @endif
                            <input type="file" name="profileimages" id="profileimages" style="display: none" onchange="loadFile(event)">
                            <h5 class="my-3 mb-5  text-capitalize">{{$user->name }}</h5>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <form action="{{ route('changeprofile',$user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">Name</label>
                                </div>
                                <div class="col-sm-0">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="border-0  mb-0" name="name" value="{{ $user->name }}">
                                </div>
                                @error('name')
                                <span class="text-danger small"> {{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">Email</label>
                                </div>
                                <div class="col-sm-0">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-8">
                                    <input type="email" class="border-0  mb-0" name="email" value="{{$user->email }}">
                                </div>
                                @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">Phone</label>
                                </div>
                                <div class="col-sm-0">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="border-0  mb-0" name="phone" value="{{ $user->phone }}" pattern="[0-9]{10}" maxlength="10">
                                </div>
                                @error('phone')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card mb-4">
                    <form method="POST" action="{{ route('change-password',$user->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">Old Password </label>
                                </div>
                                <div class="col-sm-0">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="border-0  mb-0" name="oldpassword" placeholder="Enter Your Old Password">
                                </div>
                                @error('oldpassword')
                                <span>
                                    <div class="text-danger small">{{ $message }}</div>
                                </span>
                                @enderror
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="mb-0">New Password</label>
                                </div>
                                <div class="col-sm-0">
                                    <p class="mb-0">:</p>
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" class="border-0" name="password" placeholder="Enter Your New Password">
                                </div>
                                @error('password')
                                <span>
                                    <div class="text-danger small">{{ $message }}</div>
                                </span>
                                @enderror
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    $('#viewimages').click(function() {
        $('#profileimages').click()
    });
    var loadFile = function(event) {
        var image = document.getElementById("viewimages");
        image.src = URL.createObjectURL(event.target.files[0]);
    };

</script>
@endsection

