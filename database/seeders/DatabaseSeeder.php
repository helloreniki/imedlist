<?php

namespace Database\Seeders;

use File;
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
          ->count(20))
        ->create([
          'name' => 'First',
          'email' => 'first@test.com',
        ]);

        $test_user = User::factory()
        ->create([
          'name' => 'Test',
          'email' => 'test@test.com'
        ]);
        // $user->patients()->saveMany(Patient::factory(3)->create());


        $json = file_get_contents('database/drugs.json');
        $drugs = json_decode($json);

        // create a patient
        $patient = Patient::factory()->create();
        // create drugs and attach them to that patient
        foreach ($drugs as $drug) {
          $patient->drugs()->create([
            'name' => $drug->name,
            'concentration' => $drug->concentration,
            'active_ingredient' => $drug->active_ingredient,
            'dosage_custom' => $drug->dosage_custom,
            'dosage_morning' => $drug->dosage_morning,
            'dosage_midday' => $drug->dosage_midday,
            'dosage_evening' => $drug->dosage_evening,
            'unit' => $drug->unit
          ]);
        }

        // attach patient to test user
        $test_user->patients()->save($patient);


    }
}
