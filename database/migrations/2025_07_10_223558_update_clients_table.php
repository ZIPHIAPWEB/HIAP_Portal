<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('industry_id')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('company')->nullable();
            $table->string('date_of_birth')->nullable();
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
            $table->dropColumn('industry_id');
            $table->dropColumn('affiliation');
            $table->dropColumn('company');
            $table->dropColumn('date_of_birth');
        });
    }
}
