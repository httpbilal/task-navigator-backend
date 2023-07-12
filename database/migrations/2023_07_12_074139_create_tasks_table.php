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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->date('due_date');
            $table->enum('priority', ['high', 'medium', 'low']);
            $table->unsignedBigInteger('assignees');
            $table->timestamps();

            $table->foreign('assignees')->references('id')->on('users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('tasks')->references('id')->on('tasks')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
