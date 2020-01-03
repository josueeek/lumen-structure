<?php

use Illuminate\Database\Seeder;
use App\Models\SaasBusiness;

class SaasBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $business = new SaasBusiness();
        $business->name = "Mestres";
        $business->save();
    }
}
