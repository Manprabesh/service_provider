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
        Schema::create('services',function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('service_name');
            $table->string('price');
            $table->string('location');
             $table->timestamps();

        });
        Schema::create('service_user',function(Blueprint $table){
            $table->integer('user_id');
            $table->integer('service_id');
            $table->string('status');      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_user');
    }
};
