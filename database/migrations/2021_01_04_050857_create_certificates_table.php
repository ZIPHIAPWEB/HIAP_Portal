<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('cert_no');
            $table->string('name');
            $table->string('school');
            $table->string('program');
            $table->string('total_grade');
            $table->integer('gold_medal');
            $table->integer('silver_medal');
            $table->integer('bronze_medal');
            $table->integer('total_medal');
            $table->double('proficiency');
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
        Schema::dropIfExists('certificates');
    }
}
