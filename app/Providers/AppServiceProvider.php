<?php

namespace App\Providers;

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
        function ReturnMsgSuccess($msg)
        {
            return redirect()->back()->with('success-message', $msg);
        }
        function ReturnMsgError($msg)
        {
            return redirect()->back()->with('error-message', $msg);

        }
        function ReturnMsgInfo($msg)
        {
            return redirect()->back()->with('info-message', $msg);

        }
    }
}
