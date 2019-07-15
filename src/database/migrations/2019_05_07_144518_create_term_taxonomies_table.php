<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_taxonomies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('term_id')->unsigned();
            $table->bigInteger('taxonomy_id')->unsigned();
            $table->string('description')->nullable();
            $table->bigInteger('parent_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('term_id')->references('id')->on('terms')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('term_taxonomies')
                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('term_taxonomies', function (Blueprint $table) {
            $table->dropForeign('term_taxonomies_term_id_foreign');
            $table->dropForeign('term_taxonomies_taxonomy_id_foreign');
            $table->dropForeign('term_taxonomies_parent_id_foreign');
        });
        Schema::dropIfExists('term_taxonomies');
    }
}
