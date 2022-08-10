<?php

namespace App\Console\Commands;

use App\Models\QrcodeAccessKey;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class QrcodeAccessTokenChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'QrcodeAccessTokenChange:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change QR code after every 30 minuets';


    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $access_token = Str::random(50);
        QrcodeAccessKey::where('id',1)->update(['access_key' => $access_token]);
            
    }
}
