<?php

use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration {

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        // Creates the provinces table
        Schema::create(\Config::get('laravel-id-provinces::table_name'), function($table)
        {
            $table->integer('id')->index();
            $table->integer('country_id');
            $table->string('name', 255)->default('');
            $table->string('capital', 255)->nullable();
            $table->decimal('area_km2', 10, 2)->nullable();

            $table->primary('id');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop(\Config::get('laravel-id-provinces::table_name'));
    }

}