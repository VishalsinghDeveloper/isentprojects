@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">User List</h4>
                    <div>
                        <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>History</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration  }}</td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input status-toggle" onclick="showSwal('warning-message-and-cancel','{{ $user->id }}','{{ $user->status }}')" id="{{ $user->id }}" data-user-id="{{ $user->id }}" {{ $user->status ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="{{ $user->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group-append">
                                                <a class="btn btn-sm btn-primary" href={{ route('history-view',$user->id)}} type="button">view</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="delete" href="{{ route('user-delete',$user->id ) }}" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
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

    (function($) {
        showSwal = function(type, user_id, status) {
            'use strict';
            if (type === 'warning-message-and-cancel') {
                swal({
                    title: 'Are you sure?'
                    , text: " To Change Status of User!"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3f51b5'
                    , cancelButtonColor: '#ff4081'
                    , confirmButtonText: 'Great'
                    , buttons: {
                        cancel: {
                            text: "Cancel"
                            , value: null
                            , visible: true
                            , className: "btn btn-danger"
                            , closeModal: true
                        , }
                        , confirm: {
                            text: "OK"
                            , value: true
                            , visible: true
                            , className: "btn btn-primary"
                            , closeModal: true
                        }
                    , }
                }).then((confirm) => {
                    if (confirm) {
                        updateStatus(user_id, status);
                    } else {
                        location.reload(true);
                    }
                });
            }
        }
    })(jQuery);

    function updateStatus(id, status) {
        $.ajax({
            type: "POST"
            , dataType: "json"
            , url: '/change-status'
            , data: {
                _token: '{{ csrf_token() }}'
                , 'user_id': id
                , 'status': status
            }
            , success: function(data) {
                if (data.status == true) {
                    location.reload(true);
                }
            }
        });
    }
</script>
@endsection
