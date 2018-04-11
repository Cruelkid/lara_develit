<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();

        for ($i = 0; $i < 17; $i++) {
            Company::create([
                'name' => 'Company ' . $i,
                'email' => 'company' . $i . '@test.net',
                'logo' => $i + 1 .'.jpg',
                'website' => 'website' . $i . '.net'
            ]);
        }
    }
}
