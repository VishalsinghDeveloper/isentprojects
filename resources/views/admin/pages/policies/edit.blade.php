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
                <h4 class="card-title">Update Policies</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
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
            <form class="forms-sample" id="myForm" method="POST" action="{{ route('policies-update',$policies->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="title" value="{{ old('title', $policies->title)}}">
                    @error('title')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Description<span style="color: red">*</span></label>
                    <textarea class="form-control" id='tinyMceExample' name="description" placeholder="Edit your content here...">{{ old('description', $policies->description) }}</textarea>
                    @error('description')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Update</button>
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
