<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('is_valid_rut', function($attribute, $rut, $parameters, $validator) {
            preg_match('/^[\.0-9\-]+[0-9k]$/i', $rut, $matches, PREG_OFFSET_CAPTURE, 0);
            if (count($matches) != 1) return false;
            $rut = preg_replace('/[^k0-9]/i', '', $rut);
            $dv  = substr($rut, -1);
            $numero = substr($rut, 0, strlen($rut)-1);
            $i = 2;
            $suma = 0;
            foreach(array_reverse(str_split($numero)) as $v) {
                if($i==8) $i = 2;
                $suma += $v * $i;
                ++$i;
            }
            $dvr = 11 - ($suma % 11);
            if($dvr == 11) $dvr = 0;
            if($dvr == 10) $dvr = 'K';
            if($dvr == strtoupper($dv)) return true;
            return false;
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
