<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_deceased');
            $table->bigInteger('adm_no');
            $table->string('next_of_kin');
            $table->integer('id_no');
            $table->string('permit_no');
            $table->string('county');
            $table->string('subcounty');
            $table->string('location');
            $table->string('village');
            $table->string('nearest_centre');
            $table->string('nearest_police');
            $table->string('witness');
            $table->string('witness_id');
            $table->string('auth_officer');
            $table->string('release_officer');
            $table->dateTime('release_date');
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
        Schema::dropIfExists('clearances');
    }
}
