<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StoreSeeder::class,
            StoreAddressSeeder::class,
            LipstickBrandSeeder::class,
            LipstickDetailSeeder::class,
            LipstickColorSeeder::class,
            LipstickImageSeeder::class,
            TrendGroupSeeder::class,
            TrendSeeder::class
        ]);

    }
}
