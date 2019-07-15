<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Superadmin'],
            ['name' => 'Admin'],
        ];
        foreach($data as $row) {
            Role::create($row);
        }
    }
}
