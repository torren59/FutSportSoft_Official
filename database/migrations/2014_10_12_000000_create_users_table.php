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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Documento',14)->unique();
            $table->string('Nombre',100);
            $table->string('RolId',4);
            $table->string('Celular',10);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('Direccion',200);
            $table->date('FechaNacimiento');
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->boolean('Estado');
            //$table->timestamps();
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
