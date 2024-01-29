@extends('adminend.layout.default')

@section('title')
    Test Design
@endsection

@section('content')
    <form action="{{ route("post.store") }}" method="POST">
        @csrf
        <label class="form-label" for="">Name</label>
        <input type="text" name="name" class="form-control">
        <button class="btn btn-primary mt-4">Submit</button>
    </form>
@endsection
