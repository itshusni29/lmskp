<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'PN20001',
                'name' => 'ANDI PRATAMA',
                'email' => 'andi.pratama@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-08-15',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20001',
                'ltc' => 'steel',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20002',
                'name' => 'BUDI SANTOSO',
                'email' => 'budi.santoso@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-03-20',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20002',
                'ltc' => 'steel',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20003',
                'name' => 'CITRA DEWI',
                'email' => 'citra.dewi@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-07-10',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20003',
                'ltc' => 'steel',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20004',
                'name' => 'DEDI SUPRIADI',
                'email' => 'dedi.supriyadi@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-05-05',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20004',
                'ltc' => 'steel',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20005',
                'name' => 'EKA KUSUMA',
                'email' => 'eka.kusuma@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-12-25',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20005',
                'ltc' => 'steel',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20006',
                'name' => 'FIKRI HAKIM',
                'email' => 'fikri.hakim@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-06-20',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20006',
                'ltc' => 'steel',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20007',
                'name' => 'GITA ANGELA',
                'email' => 'gita.angela@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-04-05',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20007',
                'ltc' => 'steel',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20008',
                'name' => 'HENDRA WIRAWAN',
                'email' => 'hendra.wirawan@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-01-10',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20008',
                'ltc' => 'steel',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20009',
                'name' => 'INA MARINA',
                'email' => 'ina.marina@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-10-10',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20009',
                'ltc' => 'steel',
                'sex' => 'female',
            ],


            [
                'username' => 'PN20011',
                'name' => 'CAHYA ARDIANSYAH',
                'email' => 'cahya.ardiansyah@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-01-10',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20012',
                'name' => 'DEWI ANGGRIANI',
                'email' => 'dewi.anggriani@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-03-22',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20013',
                'name' => 'EDI SETIAWAN',
                'email' => 'edi.setiawan@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-06-14',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20014',
                'name' => 'FARAH AMALIA',
                'email' => 'farah.amalia@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-08-05',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20015',
                'name' => 'GANI PRATAMA',
                'email' => 'gani.pratama@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-11-02',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20016',
                'name' => 'HANA ARDELIA',
                'email' => 'hana.ardelia@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-04-18',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20017',
                'name' => 'INDRA KUSUMA',
                'email' => 'indra.kusuma@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-07-20',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20018',
                'name' => 'JULIA PERMATASARI',
                'email' => 'julia.permatasari@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-12-25',
                'occupation' => 'Operator',
                'role' => 'participant',
                'cc' => '20010',
                'ltc' => 'aluminium',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20019',
                'name' => 'KURNIAWAN SETIAJI',
                'email' => 'kurniawan.setiaji@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-09-30',
                'occupation' => 'Operator',
                'role' => 'trainer',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'male',
            ],
            [   
                'username' => 'PN20020',
                'name' => 'LINA SUGIARTI',
                'email' => 'lina.sugiarti@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Die Casting',
                'department' => 'Production aluminium',
                'division' => 'Production 3',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-05-27',
                'occupation' => 'Manager',
                'role' => 'manager',
                'cc' => '20011',
                'ltc' => 'aluminium',
                'sex' => 'female',
            ],
            [
                'username' => 'PN20010',
                'name' => 'JAKA NUGRAHA',
                'email' => 'jaka.nugraha@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Gear & Axle',
                'department' => 'Production G&A',
                'division' => 'Production 4',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-09-05',
                'occupation' => 'Manager',
                'role' => 'manager',
                'cc' => '20010',
                'ltc' => 'steel',
                'sex' => 'male',
            ],

            [
                'username' => 'PN20021',
                'name' => 'MAHENDRA PUTRA',
                'email' => 'mahendra.putra@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'General Affair',
                'department' => 'General Affair',
                'division' => 'HRGA',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-02-14',
                'occupation' => 'Staff',
                'role' => 'trainer',
                'cc' => '20013',
                'ltc' => 'common',
                'sex' => 'male',
            ],
            [
                'username' => 'PN20022',
                'name' => 'NURUL HIDAYATI',
                'email' => 'nurul.hidayati@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'General Affair',
                'department' => 'General Affair',
                'division' => 'HRGA',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-10-05',
                'occupation' => 'Staff',
                'role' => 'trainer',
                'cc' => '20014',
                'ltc' => 'common',
                'sex' => 'female',
            ],  
            [
                'username' => 'PN20023',
                'name' => 'RAFI AKBAR',
                'email' => 'rafi.akbar@ypmi.co.id',
                'password' => Hash::make('password123'),
                'section' => 'Training',
                'department' => 'Training Development',
                'division' => 'HRGA',
                'date_of_join' => '2024-04-10',
                'date_of_birth' => '2001-06-30',
                'occupation' => 'Staff',
                'role' => 'trainer',
                'cc' => '20015',
                'ltc' => 'common',
                'sex' => 'male',
            ],
            
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
