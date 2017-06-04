<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Link;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // For using MariaDB 
        Schema::defaultStringLength(191);
        
        //Links older than 24 hours must be deleted
        Link::where('created_at', '<=', Carbon::now()->subDays(1)->toDateTimeString())->delete();


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
