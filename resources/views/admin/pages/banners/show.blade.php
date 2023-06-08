@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Banners List</h4>
                    <div>
                        <a href="{{ route('banners') }}" class="btn btn-primary mb-3">Add New</a>
                        <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    @if(session('success'))
                    <div id="success-alert" class="alert alert-success text-center">
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif
                    @if(session('error'))
                    <div id="error-alert" class="alert alert-danger text-center">
                        <span> {{ session('error') }}</span>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Imges</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $banner )
                                    <tr>
                                        <td>{{ $loop->iteration  }}</td>
                                        <td>
                                            @if(!empty($banner->images) && File::exists(public_path($banner->images)))
                                            <img src="{{ asset($banner->images) }}" style="width:350px; height: 200px;" class="rounded">
                                            @else
                                            <img src="{{ asset('uploads/noimg.jpg') }}" style="width:350px; height: 200px;" class="rounded">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $banner->title ?? "-" }}
                                        </td>
                                        <td>
                                            <a class="edit" href="{{ route('banners-edit',$banner->id) }}" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                            <a class="delete" href="{{ route('banners-delete',$banner->id) }}" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script type="text/javascript">
    (function($) {
        'use strict';
        $(function() {
            $('#order-listing').DataTable({
                "aLengthMenu": [
                    [5, 10, 15, -1]
                    , [5, 10, 15, "All"]
                ]
                , "iDisplayLength": 2
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
    $(document).ready(function() {
    // Hide success alert when clicked
    $('#success-alert').click(function() {
        $(this).hide(); // Alternatively, you can use $(this).remove() to remove the element completely from the DOM
    });

    // Hide error alert when clicked
    $('#error-alert').click(function() {
        $(this).hide(); // Alternatively, you can use $(this).remove() to remove the element completely from the DOM
    });
});
</script>
@endsection

