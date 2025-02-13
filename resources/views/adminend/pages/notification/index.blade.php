@extends('adminend.layout.default')

@section('title')
    Product list
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <h2 class="my-3 text-center">Real time notification</h2>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('93f86bba65574ddc1f23', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');

        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script>
@endpush
