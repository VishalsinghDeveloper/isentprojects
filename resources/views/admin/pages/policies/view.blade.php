@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card ">
    <div class="card">
        <div class="card-body  justify-content-center">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title"></h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <div class="ml-5">
                <h2 class="text-center mb-4"><b>{{$policies->title}}</b></h2>
                <p>{!! $policies->description !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
</script>
@endsection

