<?php

namespace App\Providers;

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
        //
        if (config('app.env') != 'local') {
            \URL::forceScheme('https');
        }
        Blade::directive('money', function ($amount) {
            return "<?php echo number_format($amount,2);?>";
});
Blade::directive('number', function ($number) {
return "<?php echo number_format($number);?>";
});

$states = ["Abia", "Adamawa", "Anambra", "Akwa Ibom", "Bauchi",
"Bayelsa", "Benue", "Borno", "Cross River", "Delta", "Ebonyi",
"Enugu", "Edo", "Ekiti", "FCT - Abuja", "Gombe", "Imo",
"Jigawa", "Kaduna", "Kano", "Katsina", "Kebbi",
"Kogi", "Kwara", "Lagos", "Nasarawa", "Niger",
"Ogun", "Ondo", "Osun", "Oyo", "Plateau",
"Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara",
];
View::share('states', $states);
}
}