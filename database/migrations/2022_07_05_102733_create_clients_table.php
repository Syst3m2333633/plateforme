<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {


            $table->id();
            // $table->string('role')->default('user');
            $table->string('raisonSocial')->unique()->nullable();
            $table->string('slug');
            $table->string('adresse')->nullable();
            $table->string('complAdresse')->nullable();
            $table->string('codePostal')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('telephone')->nullable();
            $table->string('name');
            $table->string('firstname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('avatar');
            $table->string('CodeClimate')->nullable();
            $table->string('CodeCov')->nullable();
            $table->string('CodeMatomo')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('clients');
    }
};