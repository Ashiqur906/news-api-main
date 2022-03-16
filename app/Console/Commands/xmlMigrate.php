<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\v0\XmlController;
use Illuminate\Console\Command;

class xmlMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:migrate {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wordpress xml file to laravel convert';

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

        $type = $this->argument('type');

        if($type == 'refresh'){
            $data = app(XmlController::class)->runQuery(1);

        }else{
            $data = app(XmlController::class)->runQuery(0);
     
        }
        $this->output->writeln($data);
    }
}
