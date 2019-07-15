<?php

use Illuminate\Database\Seeder;
use App\Models\Taxonomy;
use App\Models\Term;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the taxonomy ids
        $postTypeTaxID = 1;
        $categoryTaxID = 2;

        // Declare the terms
        $terms = [
            // Regular Blog Post Type
            [
                'taxonomy_id' => $postTypeTaxID,
                'tax_description' => 'Regular Blog Post Type',
                'name' => 'Regular Blog',
                'slug' => 'regular_blog',
            ],
            // Product Catalogue
            [
                'taxonomy_id' => $postTypeTaxID,
                'tax_description' => 'Lists of Products Post Type',
                'name' => 'Product Catalogue',
                'slug' => 'product_catalogue'
            ],
        ];

        foreach ($terms as $term) {
            // Save the term
            $termDb = Term::create([
                'name' => $term['name'],
                'slug' => $term['slug'],
            ]);

            // Create the relation to the taxonomy
            if ($termDb)
                $termDb->taxonomies()->attach($term['taxonomy_id'], [
                    'description' => $term['tax_description'],
                ]);
        }
    }
}
