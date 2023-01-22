@extends('layouts.mainlayouts')

@section('title', 'Class | Edit Class')

@section('content')

{{-- {{ $student }}
<br><br>
{{ $class }} --}}

    <div class="mt-5 col-8 m-auto">
        <form action="/class/{{ $class->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $class->name }}" id="name" required>
            </div>
        
            <div class="mb-3">
                <label for="teacher">Teacher</label>
                <select name="teacher_id" id="teacher" class="form-control" required>
                    <option value="{{ $class->teacher }}">{{ $class->homeroomTeacher->name }}</option>
                    @foreach ($teacher as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                    {{-- @if ($class->teacher == 'name')
                        <option value=""></option>
                    @endif --}}
                </select>
            </div>
        
            <div class="mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
    </form>
</div>


@endsection