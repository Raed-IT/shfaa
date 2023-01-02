<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fix_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('diagnosis');
            $table->string('solution')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['Don', "Active", "Invalid", "Waiting"])->default('waiting');
            $table->bigInteger('device_id');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('fix_sheets');
    }
};
