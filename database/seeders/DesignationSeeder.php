<?php

namespace Database\Seeders;

use App\Models\UserDesignation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputsNames = ['Administrator','CEO', 'Tech Lead', 'Project Manager', 'Associate Software Engineer'];
        foreach ($inputsNames  as $desig) {
            $inputs[] = ['title' => $desig, 'slug' => slugify($desig)];
        }
        UserDesignation::insert($inputs);
    }
}
