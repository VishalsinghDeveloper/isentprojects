@extends('admin.layouts.masters')
@section('css')
<style>
    .tox-statusbar__branding a {
        display: none;
    }

</style>
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Update MarketingTips</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <form class="forms-sample" id="myForm" method="POST" action="{{ route('marketing_tips-update',$marketingTip->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="title" value="{{ old('title', $marketingTip->title)}}">
                    @error('title')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Description<span style="color: red">*</span></label>
                    <textarea class="form-control" id='tinyMceExample' name="description" placeholder="Edit your content here...">{{ old('description', $marketingTip->description) }}</textarea>
                    @error('description')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Image Upload<span style="color: red">*</span></label>
                    <input type="file" name="images" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" name="images" placeholder="Upload Image" value="{{ old('images', isset($marketingTip) ? basename($marketingTip->image) : '') }}">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                    </div>
                    <div>
                        @if(!empty($marketingTip->image) && File::exists(public_path($marketingTip->image)))
                        <img src="{{ asset($marketingTip->image) }}" style="width:100px; height: 100px;" class="rounded">
                        @else
                        <img src="{{ asset('uploads/noimg.jpg') }}" style="width:100px; height: 100px;" class="rounded">
                        @endif
                    </div>
                    @error('image')
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
<script>
    function clearForm() {
        document.getElementById("myForm").reset();
    }

</script>
@endsection

