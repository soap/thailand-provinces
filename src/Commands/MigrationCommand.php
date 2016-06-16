<?php

namespace Soap\ThProvinces\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MigrationCommand extends Command {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'thprovinces:migration';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration of provinces table';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $app = app();
        $app['view']->addNamespace('thprovinces',substr(__DIR__,0,-8).'views');
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $provincesTable = Config::get('thprovinces.provinces_table');

        $this->line('');
        $this->info('Welcome to package soap/thailand-provinces');
        $this->line('');

        $message =  "The migration file will create a table '$provincesTable'"." and a seeder for the provinces data";
        $this->info($message);

        $this->line('');
        if ( $this->confirm("Create migration file? [Yes|no]", true) )
        {
            $this->line('');
            $this->info( "Creating migration and seed file..." );
            if( $this->createMigration($provincesTable))
            {
                //$this->line('');
                //$this->call('dump-autoload', array());
                $this->line('');
                $this->info( "Migration successfully created!" );
            }
            else{
                $this->error(
                    "Error! Failed to create migration.\n Check the write permissions".
                    " within the /database/migrations directory."
                );
            }
            $this->line('');
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

    /**
     * Create the migration
     *
     * @param  string $name
     * @return bool
     */
    protected function createMigration($provincesTable)
    {
        //Create the migration
        $app = app();
        $migration_file = database_path()."/migrations/".date('Y_m_d_His')."_create_provinces_table.php";


        if (!file_exists($migration_file))
        {
            $fs = fopen($migration_file, 'x');

            if ($fs) {
                $data = compact('provincesTable');

                $output = $app['view']->make('thprovinces::generators.migration')->with($data)->render();
                fwrite($fs, $output);
                fclose($fs);
            } else {
                return false;
            }
        }

        //Create the seeder
        $seeder_file = database_path()."/seeds/ProvincesSeeder.php";

        if (!file_exists( $seeder_file ))
        {
            $fs = fopen($seeder_file, 'x');
            $output = $app['view']->make('thprovinces::generators.seeder')->render();
            if ($fs) {
                fwrite($fs, $output);
                fclose($fs);
            } else {
                return false;
            }
        }

        return true;
    }
}