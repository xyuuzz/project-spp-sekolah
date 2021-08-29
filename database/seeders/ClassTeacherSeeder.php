<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class ClassTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::where("role", "teacher")->get();
        for ($i = 1; $i < SchoolClass::count(); $i++)
        {
            $user[$i-1]->class_teacher()->attach($i);
        }
    }
}
