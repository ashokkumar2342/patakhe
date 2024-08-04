<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Form;
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
        Form::macro('labelHtml', function ($name, $html) {
            return '<label for="'.$name.'">'.$html.'</label>';
        });
        Form::component('bsText', 'components.form.text', ['name', 'label','labelAttr','value','inputAttr']);
        Form::component('bsEmail', 'components.form.email', ['name', 'label','labelAttr','value','inputAttr']);
        Form::component('bsPassword', 'components.form.password', ['name', 'label','labelAttr','inputAttr']);
        
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m-d-Y h:i') ?>";
        });
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m-d-Y'); ?>";
        });
        Blade::directive('time', function ($expression) {
            return "<?php echo ($expression)->format('H:i'); ?>";
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
