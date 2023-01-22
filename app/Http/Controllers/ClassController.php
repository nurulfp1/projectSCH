<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassController extends Controller
{
    public function Index()
    {
        // eloquent orm (recommendation)
        // query builder (still ok)
        // row equery (not recommended)

        // contoh eloquent orm :

        // lazy load:-> butuh 6x query (menulis query satu per satu ke class)
        // $class = ClassRoom::all(); // cara request data -> hanya ketika butuh data children baru mengambil data 
        // select * from table class
        // select * from student where class = 1A
        // select * from student where class = 1B
        // select * from student where class = 1C
        // select * from student where class = 1D


        // eager load: -> hanya butuh 2x query (query yg ke-2 langsung mencari semua data hanya dengan satu query)
        // $class = ClassRoom::with('students','homeroomTeacher')->get(); // select * from students
        $class = ClassRoom::get(); // select * from students
        // select * from table class
        // select * from student where class in(ia,ib,ic,id)
        return view('classroom', ['classList' => $class]);
    }
    
    public function show($id)
    {
        $class = ClassRoom::with(['students', 'homeroomTeacher'])
        ->findOrFail($id);
        return view('class-detail', ['class' => $class]);

    }

    public function create()
    {
        $teacher = Teacher::select('id', 'name')->get();
        return view('class-add', ['teacher' => $teacher]);
    }

    public function store(Request $request)
    {
        // $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;       // -> satu persatu
        // $student->nis = $request->nis; 
        // $student->class_id = $request->class_id; 
        // $student->save();

        $class=ClassRoom::create($request->all()); //mass assigment, lebih ringkas

        if($class) {
            Session::flash('status', 'success');
            Session::flash('message', 'add new class success!');
        }

        return redirect('/class');
        
    }

    public function edit(Request $request, $id)
    {
        $teacher = Teacher::select('id', 'name')->get();
        $class = ClassRoom::findOrFail($id);
        $teacher = Teacher::where('id', '!=', $class->teacher_id)->get(['id', 'name']);
        return view('class-edit', ['class' => $class, 'teacher' => $teacher]);
    }

    public function update(Request $request, $id)
    {
        $class = ClassRoom::findOrFail($id);

        $class->update($request->all());  // mass updates, more simple

        if($class) {
            Session::flash('status', 'success');
            Session::flash('message', 'edit class success!');
        }

        return redirect('/class');
    }

    // public function store(Request $request)
    // {
    //     $student=Student::create($request->all()); 
    //     return redirect('/students');
        
    // }
}
