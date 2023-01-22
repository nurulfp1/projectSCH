@extends('layouts.mainlayouts')

@section('title', 'Class')

@section('content')
    <h1>Ini Halaman Class</h1>

    <div class="my-5">
        <a href="class-add" class="btn btn-primary">Add Data</a>
    </div>

    @if(Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <h3>Class List</h3>
    
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
                {{-- <th>Students</th>
                <th>Homeroom Teacher</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($classList as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>
                        <a href="class-detail/{{ $data->id }}">Detail</a>
                        <a href="class-edit/{{ $data->id }}">Edit</a>
                    </td>
                    {{-- <td>
                        @foreach ($data->students as $student)
                           - {{ $student['name'] }} <br>
                        @endforeach
                    </td>
                    <td> {{ $data->homeroomTeacher->name }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection