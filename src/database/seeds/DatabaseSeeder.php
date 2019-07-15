<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->command->info('Roles table is seeded');

        $this->call(PermissionsSeeder::class);
        $this->command->info('Permissions are seeded');

        if (env('APP_ENV') !== 'prod') {
            $this->call(UsersSeeder::class);
            $this->command->info('Users table is seeded');
        }

        $this->call(TaxonomiesSeeder::class);
        $this->command->info('Taxonomies table is seeded');

        $this->call(TermsSeeder::class);
        $this->command->info('Terms table is seeded');
    }
}
