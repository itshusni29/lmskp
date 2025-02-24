<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username' => 'PN21409',
                'name' => 'MUHAMMAD HUSNI',
                'email' => 'husni@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Training',    
                'department' => 'HR',
                'division' => 'HRGA',
                'date_of_join' => '2020-01-01',
                'date_of_birth' => '1985-05-10',
                'occupation' => 'Administrator',
                'role' => 'admin',  
                'cc' => '12345',
                'ltc' => 'common',
                'sex' => 'male',
            ],
            [
                'username' => 'RL20155',
                'name' => 'BOBY ADHI SANJAYA',
                'email' => 'boby@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Training',
                'department' => 'HR',
                'division' => 'HRGA',
                'date_of_join' => '2021-02-01',
                'date_of_birth' => '1990-07-15',
                'occupation' => 'Trainer',
                'role' => 'trainer',
                'cc' => '54321',
                'ltc' => 'common',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20024',
                'name' => 'TAUFIK ARI',
                'email' => 'taufik@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Training',    
                'department' => 'HR',
                'division' => 'HRGA',
                'date_of_join' => '2010-01-01',
                'date_of_birth' => '1985-05-10',
                'occupation' => 'Spv',
                'role' => 'admin',
                'cc' => '12345',
                'ltc' => 'common',
                'sex' => 'male',
            ],
            
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
