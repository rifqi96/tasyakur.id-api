<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'superadmin',
                'role_id' => 1,
                'email' => 'superadmin@tasyakur.id',
                'password' => app('hash')->make('secret'),
                'first_name' => 'Superadmin',
                'last_name' => 'Tasyakur',
                'status' => 'Active',
            ],
            [
                'username' => 'admin',
                'role_id' => 2,
                'email' => 'admin@tasyakur.id',
                'password' => app('hash')->make('secret'),
                'first_name' => 'Admin',
                'last_name' => 'Tasyakur',
                'status' => 'Active',
            ],
        ];

        foreach ($data as $row) {
            User::create($row);
        }
    }
}
