<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Profile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        View::composer('layout_admin.sidebar', function ($view) {
            $view->with('profile', Profile::first());
        });

        View::composer('layout_kasir.sidebar', function ($view) {
            $profile = Profile::first(); // Ambil data profil pertama
            $view->with('profile', $profile);
        });

                // Menambahkan log untuk SQL query
                DB::listen(function ($query) {
                    \Log::info($query->sql); // Menyimpan query SQL yang dijalankan ke dalam log
                });
    }
}
