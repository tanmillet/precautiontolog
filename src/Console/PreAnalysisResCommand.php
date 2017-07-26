<?php

namespace TerryLucasInterFaceLog\Logger\Console;

use Illuminate\Console\Command;
use TerryLucasInterFaceLog\Logger\Precaution;

class PreAnalysisResCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pre:res';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic Precaution Log Result Command';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $pre = new Precaution();
        $res = $pre->preport();

        $this->info($res);
    }

}
