<?php

use Illuminate\Database\Seeder;

class LipstickDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LipstickDetail::class, 10)->create();
    }
}
