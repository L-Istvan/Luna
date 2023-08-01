<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DictionaryTableNames;
use Illuminate\Support\Facades\Auth;

class HeaderViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer('layouts.header', function ($view) {
            if (auth()->check()){
                $tableNames = DictionaryTableNames::tableNamesByUser(Auth::user()->id);
                $view->with('tableNames', $tableNames);
            }
            else{
                $view->with('tableNames', 0);
            }
        });
    }

}
