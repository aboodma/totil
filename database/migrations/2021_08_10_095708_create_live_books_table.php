<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('provider_id');
            $table->text('name');
            $table->text('slug');
            $table->text('description');
            $table->text('cover');
            $table->boolean('publish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_books');
    }
}
