@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">History</h4>
                    <div>
                        <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                    </div>
                </div>
                <form class="forms-sample" id="myForm" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Sr NO.</th>
                                            <th>Description</th>
                                            <th>User</th>
                                            <th>User Phone</th>
                                            <th>Total Customers</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($uniqueOffers as $index => $offer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{$offer->description}}</td>
                                            <td>{{ $offer->user->name }}</td>
                                            <td>{{ $offer->user->phone }}</td>
                                            <td class="text-center">{{ $customerCounts[$offer->description . '|' . $offer->created_at] }}</td>
                                            <td>{{ $offer->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    (function($) {
        'use strict';
        $(function() {
            $('#order-listing').DataTable({
                "aLengthMenu": [
                    [5, 10, 15, -1]
                    , [5, 10, 15, "All"]
                ]
                , "iDisplayLength": 10
                , "language": {
                    search: ""
                }
            });
            $('#order-listing').each(function() {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });
        });
    })(jQuery);

</script>
@endsection

