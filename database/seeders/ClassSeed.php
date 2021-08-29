<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class ClassSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class = collect([
            "7A", "7B", "7C", "7D", "7E",
            "8A", "8B", "8C", "8D", "8E",
            "9A", "9B", "9C", "9D", "9E",
        ]);

        $class->each(fn($data) => SchoolClass::create(["class" => $data]));
    }
}
