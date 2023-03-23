<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('message_id');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('receiver_id')->nullable();
            $table->tinyInteger('type')->default(0)->comment('1:group message, 0:personal message');
            $table->tinyInteger('seen_status')->default(0)->comment('1:seen');
            $table->tinyInteger('deliver_status')->default(0)->comment('1:delivered');
            $table->unsignedInteger('message_group_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_messages');
    }
};
