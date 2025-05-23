<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultRangeTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_range_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rank');
            $table->text('message');
            $table->string('locale')->index();
            $table->integer('result_range_id')->unsigned();
            $table->foreign('result_range_id')->references('id')->on('result_ranges')->onDelete('cascade');
            $table->unique(['result_range_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_range_translations');
    }
}
