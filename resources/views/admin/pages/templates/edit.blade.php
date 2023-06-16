@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">update Templates</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <form class="forms-sample" id="myForm" method="POST" action="{{ route('templates-update',$template->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleTextarea1">Templates<span style="color: red">*</span></label>
                    <textarea class="form-control" id="exampleTextarea1" name="description" rows="5">{{ old('description', $template->description) }}</textarea>
                    @error('description')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Templates ID<span style="color: red">*</span></label>
                    <input class="form-control" id="exampleTextarea1" name="templates"  value="{{ old('templates', $template->template_id) }}" />
                    @error('templates')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Sender ID<span style="color: red">*</span></label>
                    <input class="form-control" id="exampleTextarea1" name="sender" value="{{ old('sender', $template->sender_id) }}"/>
                    @error('sender')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button type="button" class="btn btn-light">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection

