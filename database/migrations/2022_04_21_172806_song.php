<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song',function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('cover');
            $table->timestamp('date_list_last_played')->nullable();
            $table->timestamp('date_recently_added')->nullable();
            $table->unsignedBigInteger('id_playlist')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('id_playlist')->references('id')->on('playlist')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song');
    }
};
