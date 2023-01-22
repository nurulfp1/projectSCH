@extends('layouts.mainlayouts')

@section('title', 'Extracurricular | Add New Extracurricular')

@section('content')

    <div class="mt-5 col-8 m-auto">
        <form action="extracurriculars" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-3">
                <label for="student">Student</label>
                <select name="student_id" id="student" class="form-control" required>
                    <option value="">Select One</option>
                    @foreach ($student as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <button class="btn btn-success" type="submit">Save</button>
            </div>

        </form>
    </div>

@endsection