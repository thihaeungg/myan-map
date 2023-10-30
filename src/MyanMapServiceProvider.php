<?php

use Illuminate\Support\ServiceProvider;
use ThihaMorph\MyanMap\Commands\DataCommand;

class MyanMapServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DataCommand::class,
            ]);
        }
    }
}
