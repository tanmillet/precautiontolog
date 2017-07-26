<?php

namespace TerryLucasInterFaceLog\Logger\Console;

use Illuminate\Console\Command;
use TerryLucasInterFaceLog\Logger\Precaution;

class PreAnalysisCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pre:log {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic Precaution Log Command';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $optime = (empty($this->argument('date'))) ? date('Y-m-d') : $this->argument('optime');
        $pre = new Precaution();
        $res = $pre->pre($optime);

        $this->info($res);
    }

}
