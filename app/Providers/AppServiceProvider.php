<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->loadHelpers();
    }

    protected function loadHelpers(){
        foreach (glob(__DIR__.'/../Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    public function boot()
    {
        Builder::macro('whereLike', function($attributes, string $searchTerm) {
            foreach(array_wrap($attributes) as $attribute) {
               $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
            }
            return $this;
         });

        
    }
}
