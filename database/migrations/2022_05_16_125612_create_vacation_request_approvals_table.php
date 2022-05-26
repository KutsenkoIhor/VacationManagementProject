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
        Schema::create('vacation_request_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacation_request_id');
            $table->unsignedBigInteger('user_id');

            $table->boolean('is_approved');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();

            $table->foreign('vacation_request_id')->references('id')->on('vacation_requests');
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
        Schema::dropIfExists('vacation_request_approvals');
    }
};
