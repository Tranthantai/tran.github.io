<?php

namespace Database\Seeders;
use App\Models\Mf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MfSeeder extends Seeder
{
    
    public function run()
    {
        Mf::factory()->count(7)->create();
    }
}
