@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Add Templates</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <form class="forms-sample" id="myForm" method="POST" action="{{ route('templates-add') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleTextarea1">Templates<span style="color: red">*</span></label>
                    <textarea class="form-control" id="exampleTextarea1" name="description" rows="5"></textarea>
                    @error('description')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="button" class="btn btn-light mt-3">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection

