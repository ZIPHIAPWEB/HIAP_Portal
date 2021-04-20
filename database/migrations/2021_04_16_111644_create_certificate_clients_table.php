<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cert_layout_id')->unsigned();
            $table->string('full_name');
            $table->string('email');
            $table->string('school');
            $table->string('cert_created_at');
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
        Schema::dropIfExists('certificate_clients');
    }
}
