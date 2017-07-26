<?php

namespace TerryLucasInterFaceLog\Logger\Console;

use Illuminate\Console\Command;

class MakePreCommand extends Command
{
    use DetectsApplicationInfos;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:pre';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic views and routes';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [];

    /**
     * User: Terry Lucas
     * Date: ${DATE}
     * @var array
     */
    protected $versions = [50, 51, 52, 53, 54, 55];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $version = (int)$this->getAppVersion();
        if (!in_array($version, $this->versions)) {
            $this->error('Precaution scaffolding generated failing.The Laravel version 5.0 +');
            exit();
        }
        $this->exportViews();

        //
        file_put_contents(
            app_path('Http/Controllers/PrecautionController.php'),
            $this->compileControllerStub()
        );

        //
        file_put_contents(
            base_path('config/precaution.php'),
            file_get_contents(__DIR__ . '/stubs/precaution.stub'),
            FILE_APPEND
        );

        //
        $routeFile =  ($version < 53) ? 'app/Http/routes.php' : 'routes/web.php';
        file_put_contents(
            base_path($routeFile),
            file_get_contents(__DIR__ . '/stubs/routes.stub'),
            FILE_APPEND
        );

        //
        file_put_contents(
            base_path('database/migrations/2017_07_26_000000_create_lucas_analysis_table.php'),
            file_get_contents(__DIR__ . '/stubs/create_lucas_analysis_table.stub'),
            FILE_APPEND
        );

        //
        file_put_contents(
            base_path('database/migrations/2017_07_26_000000_create_lucas_analysis_res_table.php'),
            file_get_contents(__DIR__ . '/stubs/create_lucas_analysis_res_table.stub'),
            FILE_APPEND
        );

        //
        $this->info('Precaution scaffolding generated successfully.');
    }

    /**
     * Export the authentication views.
     *
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists(resource_path('views/' . $value))) {
                if (!$this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__ . '/stubs/views/' . $key,
                resource_path('views/' . $value)
            );
        }
    }

    /**
     * Compiles the PrecautionController stub.
     *
     * @return string
     */
    protected function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__ . '/stubs/controllers/PrecautionController.stub')
        );
    }
}
