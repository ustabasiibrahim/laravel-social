<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowablesTable extends Migration
{
    public function up()
    {
        Schema::create('followables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->morphs('followable');
            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();

            $table->index(['followable_type', 'accepted_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('followables');
    }
}
