<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        /*Route::resourceVerbs([
            'create' => 'crear',
            'show' => 'myshow',
            'edit' => 'myedit'
        ]);*/

        //share data with all views;
        //View::share('currentDate', date('Y-m-d'));
        View::share('currentDate', Carbon::now());

        \Blade::directive('dtime', function($expression) {
            return "<?php echo date('Y-m-d H:i', $expression); ?>";
        });
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
