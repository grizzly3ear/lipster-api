<?php

use Illuminate\Database\Seeder;

class TrendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Trend::class, 70)->create();
    }
}
