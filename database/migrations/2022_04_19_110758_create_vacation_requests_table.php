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
        Schema::create('vacation_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->date('start_date');
            $table->date('end_date');
            $table->integer('number_of_days');
            $table->enum('type', ['VACATIONS', 'PERSONAL_DAYS', 'SICK_DAYS']);
            $table->boolean('is_approved')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->softDeletes();

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
        Schema::dropIfExists('vacation_requests');
    }
};
