<?php

use Illuminate\Database\Seeder;

class LipstickBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LipstickBrand::class, 5)->create();
    }
}
