<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\TeacherCreateRequest;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::all();
        return view('teacher', ['teacherList' => $teacher]);
    }

    public function show($id)
    {
        $teacher = Teacher::with(['class.students','classroomClass'])
        ->findOrFail($id);
        return view('teacher-detail', ['teacher' => $teacher]);
    }

    public function create()
    {
        $class = ClassRoom::select('id', 'name')->get();
        $teacher = Teacher::select('id', 'name')->get();
        return view('teacher-add', ['teacher' => $teacher, 'class' => $class]);
    }
        
    public function store(TeacherCreateRequest $request)
    {

        $class = ClassRoom::select('id', 'name')->get();
        $teacher = Teacher::create($request->all()); //mass assigment, lebih ringkas

        if($teacher) {
            Session::flash('status', 'success');
            Session::flash('message', 'add new teacher success!');
        }

        return redirect('/teacher');
        
    }

    public function edit(Request $request, $id)
    {
        $class = ClassRoom::select('id', 'name')->get();
        $teacher = Teacher::findOrFail($id);
        $class = ClassRoom::where('id', '!=', $teacher->class_id)->get(['id', 'name']);
        return view('teacher-edit', ['teacher' => $teacher, 'class' => $class]);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $teacher->update($request->all());  // mass updates, more simple

        if($teacher) {
            Session::flash('status', 'success');
            Session::flash('message', 'edit class success!');
        }

        return redirect('/teacher');
    }

}
