@extends('layouts.mainlayouts')

@section('title', 'Teacher | Edit Teacher')

@section('content')

{{-- {{ $student }}
<br><br>
{{ $class }} --}}

    <div class="mt-5 col-8 m-auto">
        <form action="/teacher/{{ $teacher->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $teacher->name }}" id="name" required>
            </div>
        
            <div class="mb-3">
                <label for="class">Class</label>
                <select name="class" id="class" class="form-control" required>
                    <option value="{{ $teacher->class }}">{{ $teacher->classroomClass->name }}</option>
                    @foreach ($class as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach   
                    {{-- @foreach ($teacher as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach --}}
                </select>
            </div>
        
            <div class="mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
    </form>
</div>


@endsection