<?php

use Illuminate\Database\Seeder;

class StoreAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\StoreAddress::class, 10)->create();
    }
}
