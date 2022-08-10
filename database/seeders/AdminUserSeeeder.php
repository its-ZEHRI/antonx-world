<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install');
        User::create([
            'name' => 'AntonX',
            'atn_number' => '0000',
            'email' => 'antonx@gmail.com',
            'image_url' => 'https://antonxdemo.com/antonx_world_backend/public/images/logo_@4x.png',
            // 'image_url' => 'public/images/logo_@4x.png',
            'role_id' => '1',
            'password' => Hash::make('admin-000'),
        ]);
    }
}
