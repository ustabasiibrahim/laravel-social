<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_private')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
};
