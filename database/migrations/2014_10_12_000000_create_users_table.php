<?php

use App\Models\User;
use App\Models\Devis;
use App\Models\Facture;
use Illuminate\Support\Facades\Schema;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('firstname')->nullable();
            // $table->string('adresse')->nullable();
            // $table->string('complAdresse')->nullable();
            // $table->string('telephone')->nullable();
            // $table->string('raisonSocial')->unique()->nullable();
            // $table->string('codePostal')->nullable();
            // $table->string('ville')->nullable();
            // $table->string('pays')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // $table->foreignIdFor(Devis::class)->constrained();
            // $table->foreignIdFor(Facture::class)->constrained();
            $table->string('password');
            // $table->makeDirectory(storage_path('public/', 0777, true));//text(storage_path('public/'. $table->string('name')));

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
