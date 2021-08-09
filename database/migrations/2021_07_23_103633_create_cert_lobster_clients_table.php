<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertLobsterClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cert_lobster_clients', function (Blueprint $table) {
            $table->id();
            $table->string('cert_id');
            $table->string('full_name');
            $table->string('school');
            $table->string('course');
            $table->string('hours');
            $table->integer('lobster_layout_id');
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
        Schema::dropIfExists('cert_lobster_clients');
    }
}
