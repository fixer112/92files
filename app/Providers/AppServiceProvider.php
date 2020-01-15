<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        if (config('app.env') != 'local') {
            \URL::forceScheme('https');
        }
        Blade::directive('money', function ($amount) {
            return "<?php echo number_format($amount,2);?>";
});
Blade::directive('number', function ($number) {
return "<?php echo number_format($number);?>";
});

$controller = new Controller;
$settings = $controller->getSettings();

$defaultFolders = $settings['defaultFolders'];

$states = $settings['states'];

View::share('defaultFolders', $defaultFolders);
View::share('states', $states);
}
}