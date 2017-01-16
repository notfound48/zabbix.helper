<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Crypt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crypt:string {target}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crypt string by AES-256-CBC';

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
        echo encrypt($this->argument('target'));
    }
}
