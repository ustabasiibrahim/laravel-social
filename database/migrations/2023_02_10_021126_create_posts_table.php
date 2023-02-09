<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['draft', 'published']);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('channel_id')->nullable()->constrained('channels')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->boolean('is_nsfw')->default(false);
            $table->boolean('is_spoiler')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_pinned')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
