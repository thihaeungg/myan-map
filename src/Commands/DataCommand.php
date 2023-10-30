<?php

namespace ThihaMorph\MyanMap\Commands;

use Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class DataCommand extends Command
{
    protected $signature = 'myanmap:data';
    protected $description = 'That will generate datas';

    public function handle()
    {
        $expectedTables = ['cities', 'states', 'self_administers', 'townships', 'state_city', 'city_township', 'state_selfadminister'];

        $missingTables = array_filter($expectedTables, function ($table) {
            return !Schema::hasTable($table);
        });

        if (!empty($missingTables)) {
            $missingTablesList = implode(', ', $missingTables);
            $this->error("The following tables are missing: {$missingTablesList}");
        } else {
            Artisan::call('db:seed', ['--class' => 'DataSeed']);
        }
    }
}