<?php

namespace App\Console\Commands;

use App\Models\ClientDatabase;
use Database\Seeders\Client\DatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class InitializeProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:int';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Project initialization';

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
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('config:clear');
        // $this->call('passport:install');
        $this->call('passport:client');
        DB::table('oauth_clients')->where('id',1)->update([
            'secret' => 'bF1p55BdhagpuCCFDeRxwJY2zWo7xTKZieDrQ4f1'
        ]);
        
        $this->info(Artisan::output());

        return Command::SUCCESS;
    }
}
