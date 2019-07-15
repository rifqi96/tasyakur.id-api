<?php

use Illuminate\Database\Seeder;
use App\Models\Taxonomy;

class TaxonomiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Declare the taxonomy masters
        $taxonomies = [
            'post_type',
            'category',
            'tag'
        ];

        foreach ($taxonomies as $taxonomy) {
            Taxonomy::create([
                'name' => $taxonomy
            ]);
        }
    }
}
