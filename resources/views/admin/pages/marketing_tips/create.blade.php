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
                <h4 class="card-title">Add MarketingTips</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <form class="forms-sample" id="myForm" method="POST" action="{{ route('marketing_tips-store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="title">
                    @error('title')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleTextarea1">Description<span style="color: red">*</span></label>
                    <textarea class="form-control" id='tinyMceExample' name="description" placeholder="Edit your content here..."></textarea>
                    @error('description')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Image Upload<span style="color: red">*</span></label>
                    <input type="file" name="image" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="file " class="form-control file-upload-info" placeholder="Upload Image">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
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
    @endsection
    @section('js')
    <script>
        function clearForm() {
            document.getElementById("myForm").reset();
        }

    </script>
    @endsection

