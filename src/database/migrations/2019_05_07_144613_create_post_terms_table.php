<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_terms', function (Blueprint $table) {
            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('term_id')->unsigned();
            $table->integer('order_no')->default(0);

            $table->foreign('post_id')->references('id')->on('posts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['post_id', 'term_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_terms', function (Blueprint $table) {
            $table->dropForeign('post_terms_post_id_foreign');
            $table->dropForeign('post_terms_term_id_foreign');
        });
        Schema::dropIfExists('post_terms');
    }
}
