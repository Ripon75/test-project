@extends('adminend.layout.default')

@section('title')
    File list
@endsection

@section('content')
    <div>
        <a href="{{ route('file.index') }}" class="btn btn-success">File list</a>
    </div>
    <div class="mt-2">
        <div>{{ $uploadFile->title }}</div>
        <div>
            <iframe height="400" width="400" src="/uploads/{{ $uploadFile->file_name }}"></iframe>
        </div>
    </div>
@endsection
