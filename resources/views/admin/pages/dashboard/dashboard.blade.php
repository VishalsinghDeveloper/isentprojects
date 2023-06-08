@extends('admin.layouts.masters')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome Admin</h3>
            </div>
            {{-- <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light" id="datepicker" placeholder="Select Date" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-light" type="button" id="datePickerButton">
                                    <i class="ti-calendar menu-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            <div class="col-md-3 mb-4 stretch-card transparent">
                <a href="{{ route('user') }}" class="card  card-dark-blue" style="text-decoration: none">
                    <div class="card-body">
                        <p class="mb-4">Total Users</p>
                        <p class="fs-30 mb-2">{{ $usercount }}</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4 stretch-card transparent">
                <a href="{{ route('index-template') }}" class="card card-dark-blue" style="text-decoration: none">
                    <div class="card-body">
                        <p class="mb-4">Total Offer Templates</p>
                        <p class="fs-30 mb-2">{{ $templateCount }}</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4 stretch-card transparent">
                <a href="#" class="card card-dark-blue" style="text-decoration: none">
                    <div class="card-body">
                        <p class="mb-4">Today Total OffersSend</p>
                        <p class="fs-30 mb-2">{{ $offerCount }}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        var currentDate = new Date();
        $('#datepicker').datepicker({
            format: 'd M yyyy'
            , autoclose: true
            , todayHighlight: true
        }).datepicker('setDate', currentDate);

        $('#datePickerButton').on('click', function() {
            $('#datepicker').datepicker('show');
        });

        $('#datepicker').on('changeDate', function(e) {
            var selectedDate = moment(e.date).format('DD MMM YYYY');
            $('#datepicker').datepicker('hide');
            $('#datePickerButton').html('<i class="ti-calendar menu-icon"></i> ' + selectedDate);
        });

    });

</script>
@endsection
