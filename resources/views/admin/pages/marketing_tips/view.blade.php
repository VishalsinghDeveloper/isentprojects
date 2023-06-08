@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">MarketingTips</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <div class="row p-5 ">
                <div class="col-lg-12">
                    @if(!empty($marketingTip->image) && File::exists(public_path($marketingTip->image)))
                    <img src="{{ asset($marketingTip->image) }}" style="width:700px; height: 350px;" class=" shadow rounded">
                    @else
                    <img src="{{ asset('uploads/noimg.jpg') }}" style="width:750px; height: 350px;" class=" shadow rounded">
                    @endif
                </div>
            </div>
            <div class="ml-5">
                <h3><b>{{$marketingTip->title}}</b></h3>
                <p>
                    <p>{!!$marketingTip->description !!}</p>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
</script>
@endsection
