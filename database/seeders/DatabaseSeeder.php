<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Drug;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Database\Factories\DrugFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // create a user named First: for that user create 3 patients, foreach patient create 4-7 drugs
        $user = User::factory()
          ->has(Patient::factory()
              ->has(Drug::factory()->count(rand(4,7)))
          ->count(3))
        ->create([
          'name' => 'First',
          'email' => 'first@test.com',
        ]);

        // $user->patients()->saveMany(Patient::factory(3)->create());

    }
}
