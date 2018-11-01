<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_tracks', function (Blueprint $table) {
            $table->increments('sms_id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('phone');
            $table->text('message')->nullable();
            $table->integer('message_counter')->nullable();
            $table->integer('message_price')->nullable();
            $table->boolean('message_sent_status')->nullable();
            $table->string('message_sent_notes')->nullable();
            $table->boolean('message_delivery_report')->nullable();
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
        Schema::dropIfExists('sms_tracks');
    }
}
