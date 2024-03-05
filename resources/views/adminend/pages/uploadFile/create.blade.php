@extends('adminend.layout.default')

@section('title')
    File upload
@endsection

@section('content')
 <div>
    <a href="{{ route('file.index') }}" class="btn btn-success">File list</a>
    <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter your title">
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Upload file</label>
            <input type="file" name="file" class="form-control" id="file" placeholder="Upload file">
        </div>
         <div class="mb-3">
           <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
