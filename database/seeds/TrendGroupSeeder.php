<?php

use Illuminate\Database\Seeder;

class TrendGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TrendGroup::class, 2)->create();
    }
}
