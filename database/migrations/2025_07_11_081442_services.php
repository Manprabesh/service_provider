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
        Schema::create('providers',function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('service_type');
            $table->string('price');
            $table->string('pincode')->nullable();
            $table->string('DOB');
            $table->string('nationality');
            $table->string('phone');
            $table->string('pan_no')->nullable();
            $table->string('adhar_no')->nullable();
            $table->string('photo')->nullable();
            $table->string('session_id')->nullable();
            $table->string('review')->nullable();
            $table->string('experience')->nullable();
            $table->string('about')->nullable();
            $table->string('town')->nullable();
            $table->string('distric')->nullable();
            $table->string('password')->nullable();
             $table->timestamps();

        });
        Schema::create('providers_user',function(Blueprint $table){
            $table->integer('user_id');
            $table->integer('provider_id');
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
