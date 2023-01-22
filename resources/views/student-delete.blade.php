@extends('layouts.mainlayouts')

@section('title', 'Students')

@section('content')

    <div class="mt-5 col-8 m-auto">

        <div class="mt-5">
            <h2>Are you sure to detele data : {{ $student->name }} ({{ $student->nis }})</h2>

            <form style="display: inline-block" action="/student-destroy/{{ $student->id }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            
            <a href="/students" class="btn btn-primary">Cancel</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
@endsection