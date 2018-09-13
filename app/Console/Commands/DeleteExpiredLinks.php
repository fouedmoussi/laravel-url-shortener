<?php

namespace App\Console\Commands;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class DeleteExpiredLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DeleteExpiredLinks:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired Links';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (Schema::hasTable('links')) {
            //Links older than 24 hours must be deleted
            Link::where('created_at', '<=', Carbon::now()->subDays(1)->toDateTimeString())->delete();

            $this->info('Successfully deleted expired links');

            view()->composer('layouts.app', function ($view) {
                $view->with('totalLinks', Link::count());
            });
        }
    }
}
