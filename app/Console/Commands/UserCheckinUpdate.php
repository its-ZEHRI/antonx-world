<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserCheckinUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UserCheckinUpdate:Update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check isCheckin is updated or not if not then false it.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('isCheckin' ,1)->get();
        foreach( $users as $user){
            User::where('id', $user->id)->update(['isCheckin' => 0]);
        }
    }
}
