@extends('adminend.layout.default')

@section('title')
    File list
@endsection

@section('content')
    <div class="mt-2">
        <div>
            <a href="{{ route('file.create') }}" class="btn btn-success">
                Upload
            </a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tiel</th>
                <th scope="col">View</th>
                <th scope="col">Download</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($uploadFiles as $key => $file)
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $file->title }}</td>
                        <td>
                            <a href="{{ route('file.show', $file->id) }}">View</a>
                        </td>
                        <td>
                            <a href="{{ route('file.download', $file->id) }}">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
