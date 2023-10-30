<?php

namespace ThihaMorph\MyanMap\Commands;

use Artisan;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use ThihaMorph\MyanMap\Trait\DataTrait;

class DataCommand extends Command
{
    use DataTrait;

    protected $signature = 'myanmap:data';
    protected $description = 'That will generate datas';

    //Command for data seeding

    public function handle()
    {
        $expectedTables = ['states','cities','selfadministers','townships','state_city','city_township','state_selfadminister'];

        $missingTables = array_filter($expectedTables, function ($table) {
            return !Schema::hasTable($table);
        });

        if (!empty($missingTables)) {
            $missingTablesList = implode(', ', $missingTables);
            $this->error("The following tables are missing: {$missingTablesList}");
        } else {
            foreach ($expectedTables as $table) {
                $model = ucfirst(Str::singular($table));
                $modelClass = "ThihaMorph\MyanMap\Eloquent\\$model";
                $modelClass::truncate();
            }
            $this->seedData();
        }
    }
}
