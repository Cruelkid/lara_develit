<?php

use App\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::truncate();

        for ($i = 0; $i < 17; $i++) {
            Employee::create([
                'first_name' => 'First name' . $i,
                'last_name' => 'Last name' . $i,
                'company' => $i + 1,
                'email' => 'employee' . $i . '@test.net',
                'phone' => '000' . $i
            ]);
        }
    }
}
