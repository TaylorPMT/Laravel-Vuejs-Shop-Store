<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Download as DownloadHelper;

class Download extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dowload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto download file mp4 google drive';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        ini_set('memory_limit', '1064M');
        return true;
        // DownloadHelper::saveLink();
    }
}
