@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Add FAQ</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <form class="forms-sample" id="myForm" method="POST" action="{{ route('faqs-store') }}" enctype="multipart/form-data">
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
                    <textarea class="form-control" id="exampleTextarea1" name="description" rows="5"></textarea>
                    @error('description')
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
