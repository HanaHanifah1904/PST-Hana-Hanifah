<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Kirim jumlah dokumentasi berdasarkan jenis ke semua view
        View::composer('*', function ($view) {
            // Contoh: menghitung jumlah dokumentasi dengan jenis 'video'
            $jumlahDokumentasiVideo = DB::table('tb_dokumentasi')
                ->where('jenis', 'video')
                ->count();

            $view->with('jumlahDokumentasiVideo', $jumlahDokumentasiVideo);
        });
    }
}
