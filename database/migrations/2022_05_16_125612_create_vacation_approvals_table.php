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
        Schema::create('vacation_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacation_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['APPROVED', 'DENIED']);
            $table->timestamps();

            $table->foreign('vacation_id')->references('id')->on('vacations');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacation_approvals');
    }
};
