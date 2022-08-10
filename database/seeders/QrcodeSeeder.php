<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\QrcodeAccessKey;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QrcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QrcodeAccessKey::create([
            'access_key' => Str::random(50),
        ]);
    }
}
