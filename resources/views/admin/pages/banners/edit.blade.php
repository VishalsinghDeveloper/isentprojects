@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Update Banners</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <form class="forms-sample" id="myForm" method="POST" action="{{ route('banners-update',$banners->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Name" value="{{ old('title', $banners->title) }}">
                </div>
                <div class="form-group">
                    <label>Image Upload<span style="color: red">*</label>
                    <input type="file" name="images" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info"  name="images" placeholder="Upload Image" value="{{ old('images', isset($banners) ? basename($banners->images) : '') }}">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                    </div>
                    <div>
                        {!! $banners->images ? '<img src="' . asset($banners->images) . '" width="70px" height="70px" alt="Image">' : '<span>No Image</span>' !!}
                    </div>
                    @error('images')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a class="btn btn-light" onclick="clearForm()">Clear</a>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection

