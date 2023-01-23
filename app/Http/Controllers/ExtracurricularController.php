<?php

namespace App\Http\Controllers;

// use App\Models\Student;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Extracurricular;
use App\Http\Requests\ExtracurricularCreateRequest;

class ExtracurricularController extends Controller
{
    public function index()
    {
        // $ekskul = Extracurricular::with('students')->get();
        $ekskul = Extracurricular::get();
        return view('extracurricular', ['ekskulList' => $ekskul]);
    }

    public function show($id)
    {
        $ekskul = Extracurricular::with(['students'])->findOrFail($id);
        return view('extracurricular-detail', ['ekskul' => $ekskul]);
    }

    public function create()
    {

        $student = Student::select('id', 'name')->get();
        $ekskul = Extracurricular::select('id')->get();
        return view('extracurricular-add', ['student' => $student], ['ekskul' => $ekskul]);
    }
        
    public function store(ExtracurricularCreateRequest $request)
    {

        // $ekskul = new Extracurricular;
        // $ekskul->name = $request->name;
        // $ekskul->student_id = $request->student_id; 
        // $ekskul->extracurricular_id = $request->extracurricular_id; 
        // $ekskul = Extracurricular::select('id')->get();
        // foreach ($ekskul as $extracurricular_id) {
        //     array_push($ekskul, $value * 2);
        // }
        // $ekskul->save();

        $ekskul=Extracurricular::create($request->all()); //mass assigment, lebih ringkas
        return redirect('/extracurricular');
        
    }
}
