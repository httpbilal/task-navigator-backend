<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


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
        Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
            if (empty($value)) {
                // If the value is empty, it's considered valid (nullable rule).
                return true;
            }

            // Check if the value is a valid base64-encoded string.
            if (!preg_match('/^data:image\/(jpeg|png|gif);base64,/', $value)) {
                return false;
            }

            // Attempt to decode the base64 image data.
            $decodedImage = base64_decode(preg_replace('/^data:image\/(jpeg|png|gif);base64,/', '', $value));

            // Check if the image data could be decoded successfully.
            if (!$decodedImage) {
                return false;
            }

            // Additional checks if needed (e.g., image dimensions, file size).

            return true;
        });
    }
}
