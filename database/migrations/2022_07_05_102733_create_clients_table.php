<?php

use App\Models\User;
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
            //Main elements
            $table->string('raisonSocial')->unique()->nullable();
            $table->string('slug')->unique();
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

            //Logo
            $table->text('avatar');
            //Token
            $table->string('CodeClimate')->nullable();
            $table->string('CodeCov')->nullable();
            $table->string('CodeMatomo')->nullable();
            //Foreign Key
            $table->foreignIdFor(User::class)->constrained();
            //Other
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
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('clients');
    }
};
