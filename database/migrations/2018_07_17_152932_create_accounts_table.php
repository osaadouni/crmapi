<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('email', 254)->unique();
            $table->string('phone', 20);
            $table->enum('industry', array('FINANCE', 'HEALTHCARE', 'INSURANCE', 'MANUFACTURING', 'PUBLISHING', 'REAL ESTATE', 'SOFTWARE'))->nullable();
            $table->string('website', 255)->nullable();
            $table->text('description')->nullable();
            $table->boolean('isActive')->default(false);
            $table->unsignedInteger('assigned_to');
            $table->unsignedInteger('createdBy');
            #$table->foreign('createdBy')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

            $table->index('name');
            $table->index('industry');
            $table->index('website');
            $table->index('isActive');
            $table->index('assigned_to');
            $table->index('createdBy');
        });

        Schema::table('accounts', function(Blueprint $table) { 
            $table->foreign('createdBy')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
