<?php

namespace Database\Seeders;

use App\Models\{Profile, SchoolClass, User};
use Faker\Factory;
use Illuminate\Database\Seeder;
use function random_int;
use function uniqid;

class ProfileSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class = [
            "7A", "7B", "7C", "7D", "7E",
            "8A", "8B", "8C", "8D", "8E",
            "9A", "9B", "9C", "9D", "9E",
        ];
        $users = User::where("role", "student")->get();

        for($i = 0; $i < $users->count(); $i++)
        {
            $users[$i]->profile()->create( [
                "class_id" => SchoolClass::find(random_int(1, 3))->id,
                "NISN" => "" . random_int(10000000000, 99999999999),
                "NIS" => "" . random_int(0, 9999),
                "photo_profile" => uniqid(),
                "address" => Factory::create()->address(),
                "number_phone" => "091201" .  $i,
                "slug" => "apapapa" . uniqid()
            ] );
        }
    }

    protected function data_arr($index)
    {
        return ;
    }
}
