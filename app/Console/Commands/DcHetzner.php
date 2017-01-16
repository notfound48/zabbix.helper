<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DcHetzner as DcHetznerObj;

class DcHetzner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dc:hetzner {method} {username} {password} {metrics}
    {--S|server_name=}
    {--D|date_format}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'API Hetzners Data Center';

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
        $DcHetzher = new DcHetznerObj($this->argument('username'), $this->argument('password'));

        $result = call_user_func(
            array($DcHetzher, $this->argument('method')),
            $this->options())
        [$this->argument('method')][$this->argument('metrics')];

        if ($this->argument('method') == 'server' && $this->argument('metrics') == 'status') {
            ($result == 'ready') ? $result = 1 : $result = 0;
        }

        if (!empty($this->option('date_format')))
        {
            $result = date('Ymd',strtotime($result));
        }

        echo $result;
    }
}
