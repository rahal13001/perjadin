<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('foto', 100);
            $table->string('nama', 100);
            $table->char('nip', 18)->unique();
            $table->integer('umur', false);
            $table->string('pangkat', 200);
            $table->string('jabatan', 200);
            $table->string('email', 100)->unique();
            $table->string('no_hp', 100)->unique();
            $table->string('password', 255)->default('12345');
            $table->boolean('status');
            $table->tinyInteger('tipe', false)->default(3);
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
        Schema::dropIfExists('employes');
    }
}
