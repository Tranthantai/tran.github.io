<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Car;
class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('cars')->insert([
            'make' => Str::random(10),
            'model' => Str::random(10),
            'produced_on' => date("Y-m-d"),
           ]);
           */
          Car::factory()->count(50)->create();
    }
}
