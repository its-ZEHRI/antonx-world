<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputsNames = ['Super Admin', 'Admin', 'User'];
        foreach($inputsNames  as $role)
          {
             $inputs[]=['title'=>$role, 'slug' =>slugify($role)];
          }    
          UserRole::insert($inputs);   
    }
}
