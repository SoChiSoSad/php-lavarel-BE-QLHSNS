<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'users.list',
            'users.view',
            'users.create',
            'users.update',
            'users.delete',
        ];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin_role = Role::firstOrCreate(['name' => 'admin']);
        $admin_role->givePermissionTo($permissions);

        $admin = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin',
            'gender' => '1',
            'address' => 'Ha Noi',
            'citizen_identification_card' => '014725836915',
            'date_of_birth' => '2003-01-01',
            'phone_number' => '0905123434',
            'email_verified_at' => now(),
            'username' => 'admin',
            'password' => 'password',
            'job_position' => 'Giám đốc',
            'working_unit' => 'FBU',
            'salary_level' => '0',
            'date_start_work' => '2021-09-01',
            'experience_degree_information' => 'Tiến Sĩ',
            'note' => 'Không',
            'remember_token' => Str::random(10),
        ]);

        $admin->syncRoles($admin_role);
        $admin->givePermissionTo($permissions);

        $leader_permissions = [
        ];

        $leader_role = Role::firstOrCreate(['name' => 'leader']);
        $leader_role->givePermissionTo($leader_permissions);

        $personnel_permissions = [
        ];

        $personnel_role = Role::firstOrCreate(['name' => 'personnel']);
        $personnel_role->givePermissionTo($personnel_permissions);

        $faker = Faker::create('vi_VN');
        $jobPositions = ['Trưởng phòng', 'Phó phòng', 'Chuyên viên'];
        $salaryLevels = ['1000 USD', '2000 USD', '3000 USD'];
        $degrees = ['Cử nhân', 'Thạc sĩ', 'Tiến sĩ', 'Kỹ sư'];

        foreach (range(1, 10) as $index) {
            $lastName = $faker->lastName;
            $middleName = $faker->lastName;
            $firstName = $faker->firstName;
            $fullName = "$lastName $middleName $firstName";

            $asciiLastName = Str::slug($lastName, '');
            $asciiMiddleName = Str::slug($middleName, '');
            $asciiFirstName = Str::slug($firstName, '');
            $email = strtolower($asciiLastName . $asciiMiddleName . $asciiFirstName) . '@gmail.com';
            $username = strtolower($asciiLastName . $asciiMiddleName . $asciiFirstName);

            $manager = User::create([
                'name' => $fullName,
                'gender' => rand(0, 1),
                'address' => $faker->address,
                'citizen_identification_card' => $faker->regexify('[0-9]{12}'),
                'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                'phone_number' => $faker->phoneNumber,
                'email' => $email,
                'email_verified_at' => now(),
                'username' => $username,
                'password' => 'password',
                'job_position' => $faker->randomElement($jobPositions),
                'working_unit' => 'FBU',
                'salary_level' => $faker->randomElement($salaryLevels),
                'date_start_work' => $faker->dateTimeThisDecade()->format('Y-m-d'),
                'experience_degree_information' => $faker->randomElement($degrees),
                'note' => 'Không',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $assignedRole = $faker->randomElement([$leader_role, $personnel_role]);
            $manager->assignRole($assignedRole);

            if ($assignedRole->name === 'leader') {
                $manager->givePermissionTo($leader_role);
            } else if ($assignedRole->name === 'personnel') {
                $manager->givePermissionTo($personnel_role);
            }
        }
    }
}
