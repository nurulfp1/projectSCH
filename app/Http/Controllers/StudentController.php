<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StudentCreateRequest;

class StudentController extends Controller
{

    public function Index(Request $request)
    {
        // $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])->get();
        // $student = Student::withTrashed()->get(); ==> jika ingin melihat atau menampilkan data yang telah dihapus
        $keyword = $request->keyword;

        $student = Student::with('class')
                            ->where('name', 'LIKE', '%'.$keyword.'%')
                            ->orWhere('gender', $keyword)
                            ->orWhere('nis', 'LIKE', '%'.$keyword.'%')
                            ->orWhereHas('class', function($query) use($keyword){
                                $query->where('name', 'LIKE', '%'.$keyword.'%');
                            })
                            ->paginate(15);
        return view('student', ['studentList' => $student]);
        
    }
    
    public function show($id)
    {
        $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])
        ->findOrFail($id);
        return view('student-detail', ['student' => $student]);
        
    }

    public function create()
    {
        $class = ClassRoom::select('id', 'name')->get();
        return view('student-add', ['class' => $class]);
    }

    public function store(StudentCreateRequest $request)
    {
        // $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;       // -> satu persatu
        // $student->nis = $request->nis; 
        // $student->class_id = $request->class_id; 
        // $student->save();

        // $validated = $request->validate([
        //     'nis' => 'unique:students|max:8|required',
        //     'name' => 'max:50|required',
        //     'gender' => 'required',
        //     'class_id' => 'required',
        // ]);

        $newName= '';

        if($request->file('photo')){
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name.'-'.now()->timestamp.'-'.$extension;
            $request->file('photo')->storeAs('photo', $newName);
        }


        $request['image'] = $newName;
        $student = Student::create($request->all()); //mass assigment, lebih ringkas

        if($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'add new student success!');
        }


        return redirect('/students');
        
    }

    public function edit(Request $request, $id)
    {
        $student = Student::with('class')->findOrFail($id);
        $class = ClassRoom::where('id', '!=', $student->class_id)->get(['id', 'name']);

        return view('student-edit', ['student' => $student, 'class' => $class]);
    }
    
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        if($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'edit student success!');
        }
        
        $student->update($request->all());  // mass updates, more simple
        return redirect('/students');
    }
    
    public function delete(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        return view('student-delete', ['student' => $student]);
    }
    
    public function destroy($id)
    {
        $deletedStudent = Student::findOrFail($id);
        $deletedStudent->delete();
        
        if($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'delete student success!');
        }
        
        return redirect('/students');
    }
    
    public function deletedStudent()
    {
        $deletedStudent = Student::onlyTrashed()->get();
        return view('student-deleted', ['student' => $deletedStudent]);
    }
    
    public function restore($id)
    {
        $deletedStudent = Student::withTrashed()->where('id', $id)->restore();

        if($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'restore student success!');
        }

        return redirect('/students');
        
    }

        // $nilai = [9, 8, 7, 6, 4, 8, 9, 1, 10, 3, 9, 7, 1, 5, 3, 9];

        // contoh method

        //// php biasa
        //// 1. hitung jumlah nilai
        //// 2. hitung berapa banyak nilai
        //// 3. hitung nilai rata-rata = total nilai / count nilai

        // $countNilai = count($nilai);
        // $totalNilai = array_sum($nilai);
        // $nilaiRataRata = $totalNilai / $countNilai;

        // dd($nilaiRataRata);

        //// collection dan method-methodnya
        //// 1. hitung rata-rata nilai
        // $nilaiRataRata = collect($nilai)->avg();
        // dd($nilaiRataRata);

        // method contains = cek apakah sebuah array memiliki sesuatu, misal cek apakah ada nilai 10 atau cek nilai kurang/lebih dari a/value
        // $test = collect($nilai)->contains(function ($value){
        //     return $value < 6;
        // });

        // dd($test);

        // method diff
        // $restauranA = ["burger", "siomay", "pizza", "spaghetti", "makaroni", "martabak", "bakso"];
        // $restaurantB = ["pizza", "fried chicken", "martabak", "sayur asem", "pecel lele", "bakso"];

        // $menuRestoA = collect($restauranA)->diff($restaurantB); // cek menu resto A yang tidak ada di resto B
        // $menuRestoB = collect($restaurantB)->diff($restauranA); // cek manu resto B yang tidak ada di resto A
        // dd($menuRestoB);

        // method filter -> menyaring
        // $coba = collect($nilai)->filter(function($value){  
        //     return $value > 7;   // akan menyaring atau mendapatkan data yang nilainya lebih dari 7
        // })->all();

        // dd($coba);

        // method pluck = mendapatkan data berupa nama atau umur nya saja
        // $biodata = [
        //     ['nama' => 'nurul', 'umur' => 1],
        //     ['nama' => 'ana', 'umur' => 2],
        //     ['nama' => 'elsa', 'umur' => 3],
        //     ['nama' => 'naruto', 'umur' => 4],
        // ];

        // $cek = collect($biodata)->pluck('nama')->all();
        // dd($cek);


        // method map() -> lebih ke perulangan atau looping
        // kita akan mencari tahu hasil dari nilai dikali 2 dari data2 yang ada di array $nilai

        //contoh menggunakan foreach
        // $nilaiKaliDua = [];
        // foreach ($nilai as $value) {
        //     array_push($nilaiKaliDua, $value * 2);
        // }

        // dd($nilaiKaliDua);

        //contoh menggunakan map()
        // $cek = collect($nilai)->map(function($value){
        //     return $value * 2;
        // })->all();

        // dd($cek);


        //// eloquent orm (recommendation) -> biasanya lebihh singkat/simple
        //// query builder (still ok) -> lebih panjang
        //// row equery (not recommended)

        //// contoh eloquent orm :
        // $student = Student::all(); // select * from students  // get data
        // return view('student', ['studentList' => $student]);
        // $student = Student::all();
        // dd($student);
        // Student::create([           // create/insert data
        //     'name' => 'eloquent',
        //     'gender' => 'P',
        //     'nis' => '4190059',
        //     'class_id' => 2,
        // ]);

        // Student::find(27)->update([   // update data
        //     'name' => 'eloquent 2',
        //     'class_id' => 1
        // ]);

        // Student::find(27)->delete();


        //// contoh query builder
        // $student = DB::table('students')->get();  //get data
        // dd($student);
        // DB::table('students')->insert([  // create/insert data
        //     'name' => 'query builder',
        //     'gender' => 'L',
        //     'nis' => '4190057',
        //     'class_id' => 1,
        // ]);
        
        // DB::table('students')->where('id', 26)->update([   // update data
        //     'name' => 'query builder 2',
        //     'class_id' => 3
        // ]);

        // DB::table('students')->where('id', 26)->delete();
        
        //// insert into students ('name', 'gender', 'nis', 'class_id') value (.....)
        
    
}
