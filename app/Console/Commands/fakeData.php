<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
// use Database\Seeds;
// use Database\Seeds\UsersAndItemesSeeder;

class fakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fake data (100000 itemes products/ 100 users)';

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
     * @return mixed
     */
    public function handle()
    {
      Artisan::call('db:seed --class=UsersAndItemesSeeder'); 
      $this->info("successfully fake data (10000 items / 100 users) !");
    }
}
