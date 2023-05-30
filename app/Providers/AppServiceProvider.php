<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // $websiteCustomization = WebsiteCustomization::first();
        // $config = [
        //     'logo' => $websiteCustomization->logo,
        //     'logo_2' => $websiteCustomization->logo_2,
        //     'logo_3' => $websiteCustomization->logo_3,
        //     'email' => $websiteCustomization->email,
        //     'phone' => $websiteCustomization->phone_number,
        //     'phone_2' => $websiteCustomization->phone_number_2,
        //     'email_2' => $websiteCustomization->email_2,
        //     'address' => $websiteCustomization->address,
        //     'address_2' => $websiteCustomization->address_2,
        //     'timing' => $websiteCustomization->timing,
        //     'timing_2' => $websiteCustomization->timing_2,
        //     'copyright' => $websiteCustomization->copyright,
        //     'footer_about' => $websiteCustomization->footer_about,
        //     'color' => $websiteCustomization->color,
        //     'color_2' => $websiteCustomization->color_2,
        //     'color_3' => $websiteCustomization->color_3,
        //     'color_3' => $websiteCustomization->color_3,
        //     'facebook' => $websiteCustomization->facebook,
        //     'twitter' => $websiteCustomization->twitter,
        //     'instagram' => $websiteCustomization->instagram,
        //     'linkedin' => $websiteCustomization->linkedin,
        //     'behance' => $websiteCustomization->behance,
        //     'pinterest' => $websiteCustomization->pinterest,
        // ];
        // view()->share('websiteCustomization', $config);
    }
}
