<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
        $user = null;
        $level = session('level');
        if ($level === 'ADM') {
            $user = Admin::where('username', session('user')->username ?? null)->first();
        } elseif ($level === 'DSN') {
            $user = Dosen::where('nip', session('user')->nip ?? null)->first();
        } elseif ($level === 'MHS') {
            $user = Mahasiswa::where('nim', session('user')->nim ?? null)->first();
        }
        $view->with('authUser', $user);
        $view->with('authLevel', $level);
    });
    }
}
