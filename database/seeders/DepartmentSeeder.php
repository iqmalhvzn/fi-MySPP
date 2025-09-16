<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'Computer Science',
            'semester' => 1,
            'cost' => 8000000,
        ]);
        Department::create([
            'name' => 'Computer Science',
            'semester' => 2,
            'cost' => 9000000,
        ]);
        Department::create([
            'name' => 'Computer Science',
            'semester' => 3,
            'cost' => 10000000,
        ]);
        Department::create([
            'name' => 'Computer Science',
            'semester' => 4,
            'cost' => 11000000,
        ]);
        Department::create([
            'name' => 'Computer Science',
            'semester' => 5,
            'cost' => 12000000,
        ]);
        Department::create([
            'name' => 'Computer Science',
            'semester' => 6,
            'cost' => 13000000,
        ]);
        Department::create([
            'name' => 'Computer Science',
            'semester' => 7,
            'cost' => 14000000,
        ]);
        Department::create([
            'name' => 'Computer Science',
            'semester' => 8,
            'cost' => 15000000,
        ]);

        Department::create([
            'name' => 'Information Systems',
            'semester' => 1,
            'cost' => 7000000,
        ]);
        Department::create([
            'name' => 'Information Systems',
            'semester' => 2,
            'cost' => 8000000,
        ]);
        Department::create([
            'name' => 'Information Systems',
            'semester' => 3,
            'cost' => 9000000,
        ]);
        Department::create([
            'name' => 'Information Systems',
            'semester' => 4,
            'cost' => 10000000,
        ]);
        Department::create([
            'name' => 'Information Systems',
            'semester' => 5,
            'cost' => 11000000,
        ]);
        Department::create([
            'name' => 'Information Systems',
            'semester' => 6,
            'cost' => 12000000,
        ]);
        Department::create([
            'name' => 'Information Systems',
            'semester' => 7,
            'cost' => 13000000,
        ]);
        Department::create([
            'name' => 'Information Systems',
            'semester' => 8,
            'cost' => 14000000,
        ]);

        Department::create([
            'name' => 'Business Administration',
            'semester' => 1,
            'cost' => 6000000,
        ]);

        Department::create([
            'name' => 'Business Administration',
            'semester' => 2,
            'cost' => 7000000,
        ]);

        Department::create([
            'name' => 'Business Administration',
            'semester' => 3,
            'cost' => 8000000,
        ]);

        Department::create([
            'name' => 'Business Administration',
            'semester' => 4,
            'cost' => 9000000,
        ]);

        Department::create([
            'name' => 'Business Administration',
            'semester' => 5,
            'cost' => 10000000,
        ]);

        Department::create([
            'name' => 'Business Administration',
            'semester' => 6,
            'cost' => 11000000,
        ]);

        Department::create([
            'name' => 'Business Administration',
            'semester' => 7,
            'cost' => 12000000,
        ]);

        Department::create([
            'name' => 'Business Administration',
            'semester' => 8,
            'cost' => 13000000,
        ]);


    }
}
