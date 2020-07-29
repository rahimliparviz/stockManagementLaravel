<?php

use Illuminate\Database\Seeder;

class RegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regulations = \App\Models\Regulations::first();

        if (!$regulations){
            $regulations = new \App\Models\Regulations();
        }
        $regulations->vat= 0;
        $regulations->logo=null;
        $regulations->favicon=null;
        $regulations->phone=null;
        $regulations->email=null;
        $regulations->address=null;

        $regulations->save();
    }
}
