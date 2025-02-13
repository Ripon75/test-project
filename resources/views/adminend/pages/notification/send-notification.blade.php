@extends('adminend.layout.default')

@section('title')
    Product list
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('admin.send.notifications') }}" method="GET">
                <div class="form-group mb-2">
                    <label for="message">Message</label>
                    <input type="text" class="form-control" id="message" placeholder="Enter message" name="message">
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
