<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // Student::truncate();
        // Schema::enableForeignKeyConstraints();

        // $data = [
        //     ['name' => 'ana', 'gender' => 'P', 'nis' => '4190051', 'class_id' => 2],
        //     ['name' => 'ehsan', 'gender' => 'L', 'nis' => '4190052', 'class_id' => 2],
        //     ['name' => 'elsa', 'gender' => 'P', 'nis' => '4190053', 'class_id' => 1],
        //     ['name' => 'mail', 'gender' => 'L', 'nis' => '4190054', 'class_id' => 3],
        // ];

        // foreach ($data as $value){
        //     Student::insert([
        //         'name' => $value['name'],
        //         'gender' => $value['gender'],
        //         'nis' => $value['nis'],
        //         'class_id' => $value['class_id'],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }

        Student::factory()->count(20)->create();
    }
}
