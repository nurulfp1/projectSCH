@extends('layouts.mainlayouts')

@section('title', 'Students')

@section('content')
    <h1>Ini Halaman Student</h1>

    <div class="my-5 d-flex justify-content-between">
        <a href="student-add" class="btn btn-primary">Add Data</a>
        <a href="student-deleted" class="btn btn-info">Show Deleted Data</a>
    </div>

    @if(Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <h3>Student List</h3>

    <div class="my-3 mb-3 col-12 col-sm-8 col-md-5">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="keyword">
                <button class="input-group-text btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>NIS</th>
                <th>Class</th>
                <th>Action</th>
                {{-- <th>Class</th>
                <th>Extracurricular</th>
                <th>Homeroom Teacher</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($studentList as $data)
                <tr>
                   <td>{{ $loop->iteration }}</td> 
                   <td>{{ $data->name }}</td> 
                   <td>{{ $data->gender }}</td> 
                   <td>{{ $data->nis }}</td> 
                   <td>{{ $data->class->name }}</td>
                   <td>
                        @if (Auth::user()->role_id != 1 && Auth::user()->role_id !=2)
                            -
                        @else
                            <a href="student/{{ $data->id }}">Detail</a>
                            <a href="student-edit/{{ $data->id }}">Edit</a>
                        @endif

                        @if (Auth::user()->role_id == 1)
                            <a href="student-delete/{{ $data->id }}">Delete</a>
                            
                        @endif
                   </td>
                   {{-- <td>{{ $data->class['name'] }}</td> 
                   <td>
                        @foreach ($data->extracurriculars as $item)
                            -{{ $item->name }} <br>
                        @endforeach
                   </td>
                   <td>{{ $data->class->homeroomTeacher->name }}</td> --}}
                    {{-- {{ $data->name }} | {{ $data->gender }} | {{ $data->nis }} || {{ $data->class_id }} --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="my-5">
        {{ $studentList->withQueryString()->links() }}
    </div>
@endsection

        {{-- @for ($i = 0; $i < 5; $i++)
            {{ $i }} <br/>
        @endfor --}}

        {{-- @if ($role == 'admin')
            <a href="">Ke halaman admin</a>
        @elseif ($role == 'staff')
            <a href="">Ke halaman gudang</a>
        @else
            <a href="">Ke halaman lain</a>
        @endif --}}

        {{-- @switch($role)
            @case($role == 'admin')
                <a href="">ke halaman admin</a>
                @break
            @case($role == 'staff')
                <a href="">ke halaman gudang</a>
                @break
        
            @default
                <a href="">ke halaman lain</a>
                
        @endswitch --}}
