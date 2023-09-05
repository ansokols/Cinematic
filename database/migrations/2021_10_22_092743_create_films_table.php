<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('film_id');
            $table->string('film_name');
            $table->string('age')->nullable();
            $table->year('release_date')->nullable();
            $table->string('original_name');
            $table->string('director')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->decimal('rating_imdb', 3, 1)->nullable();
            $table->string('language')->nullable();
            $table->string('genre')->nullable();
            $table->time('seance_time')->nullable();
            $table->string('production')->nullable();
            $table->string('studio')->nullable();
            $table->string('script')->nullable();
            $table->string('main_cast')->nullable();
            $table->text('description')->nullable();
            $table->string('trailer_url')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
//            $table->decimal('rating', 2, 1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
