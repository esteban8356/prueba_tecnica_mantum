<?php

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    public function run()
    {
        State::insert([
            ['name' => 'Processing'],
            ['name' => 'Completed'],
            ['name' => 'Canceled'],
        ]);
    }
}
