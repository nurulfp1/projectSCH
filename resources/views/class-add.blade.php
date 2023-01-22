@extends('layouts.mainlayouts')

@section('title', 'Class | Add New Class')

@section('content')

    <div class="mt-5 col-8 m-auto">
        <form action="clas" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-3">
                <label for="teacher">Teacher</label>
                <select name="teacher_id" id="teacher" class="form-control" required>
                    <option value="">Select One</option>
                    @foreach ($teacher as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <button class="btn btn-success" type="submit">Save</button>
            </div>

            {{-- {{ $class }} --}}
        </form>
    </div>

@endsection