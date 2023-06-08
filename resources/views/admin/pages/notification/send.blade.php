@extends('admin.layouts.masters')
@section('css')
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
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
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Send Notification</h4>
                <div>
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
            <form class="forms-sample" id="myForm" method="POST" action="{{ route('notification-send') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleTextarea1">Title<span style="color: red">*</span></label>
                    <input class="form-control" id="exampleTextarea1" name="title" rows="5" />
                    @error('title')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Messages<span style="color: red">*</span></label>
                    <textarea class="form-control" id="exampleTextarea1" name="message" rows="5"></textarea>
                    @error('message')
                    <span>
                        <div class="text-danger small">{{ $message }}</div>
                    </span>
                    @enderror
                </div>
                <button type="button" class="btn btn-primary mr-2" id="showuser">Send To</button>
                <div id="userList" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center">
                        <label>
                        <input type="checkbox" id="selectAll">
                            Select All
                        </label>
                        <div class="form-group" id="userbtn" style="display: none;">
                            <button type="submit" class="btn btn-primary mr-2 mb-2 mt-2">Send</button>
                            <a id="hideusers" class="btn btn-primary mb-2 mt-2">Cancle</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($user as $user)
                        <div class="col-md-3 col-sm-6">
                            <div class="customer-card">
                                <input type="checkbox" name="users[]" value="{{ $user->id }}" id="users{{ $user->id }}" style="margin-left: auto;">
                                @if(!empty($user->images) && File::exists(public_path($user->images)))
                                <img src="{{ asset($user->images) }}" class="rounded">
                                @else
                                <img src="{{ asset('uploads/noimg.webp') }}" class="rounded">
                                @endif
                                <label for="users{{ $user->id }}">{{ $user->name }} <br>
                                    <span>{{ $user->phone }}</span></label>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

@endsection
@section('js')

<script>
   $(document).ready(function() {
    $('#showuser').click(function() {
        $('#userList').slideDown();
        $('#userbtn').show();
        $(this).hide();
    });

    $('#hideusers').click(function() {
        $('#userList').slideUp(200, function() {
            $('#showuser').show();
        });
        $('#userbtn').hide(200);
    });
        $('#selectAll').click(function() {
            $('input[name="users[]"]').prop('checked', this.checked);
        });

        $('#sendButton').click(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            var selectedCustomers = $('input[name="users[]"]:checked').map(function() {
                return this.value;
            }).get();

            if (selectedCustomers.length === 0) {
                alert('Please select at least one user.');
                return;
            }
        });
    });
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
