<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            UserSeeder::class,
            AdminSeeder::class,
            OrderSeeder::class,
            BodyShapeSeeder::class,
            ChatSeeder::class,
            ComplaintSuggestionSeeder::class,
            ContactWithUsSeeder::class,
            FQSSeeder::class,
            HomePageSlideSeeder::class,
            MessageSeeder::class,
            NotificationSeeder::class,
            OrderPackageOptionSeeder::class,
            OrderResponseSeeder::class,
            OurServiceSeeder::class,
            PackageSeeder::class,
            PackageOptionSeeder::class,
            ResetPasswordSeeder::class,
            SettingSeeder::class,
            SizeSeeder::class,
            SocialSeeder::class,
            SubscriptionSeeder::class,
            SuccessPartnerSeeder::class,
            SystemTextSeeder::class,
            OrderImageSeeder::class,

        ]);
    }
}
