<?php

namespace App\Console\Commands;

use App\Models\Test;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class Testt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $test = ['name' => 'hello world'];
        Test::create($test);
    }
}
