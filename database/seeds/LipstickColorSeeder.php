<?php

use Illuminate\Database\Seeder;

class LipstickColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LipstickColor::class, 40)->create()->each(function ($lipstickColor) {
            $lipstickColor->storeAddresses()->attach(
                rand(1, 10)
            );
        });
    }
}
