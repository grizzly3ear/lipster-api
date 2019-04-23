<?php

use Illuminate\Database\Seeder;

class LipstickImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LipstickImage::class, 70)->create();
    }
}
