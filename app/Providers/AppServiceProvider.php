<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
    
    public function boot(\Illuminate\Http\Request $request)
    {
        Relation::enforceMorphMap([
            'admin' => 'App\Models\Admin',
            'trader' => 'App\Models\Trader',
            'investor' => 'App\Models\Investor',
        ]);


        if (!empty( env('NGROK_URL') ) && $request->server->has('HTTP_X_ORIGINAL_HOST')) {
            $this->app['url']->forceRootUrl(env('NGROK_URL'));
        }

        // other code
}
}
