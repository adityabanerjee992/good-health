<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('scheduletypes', function($table) {
            $table->increments('id');
            $table->string('name',50);
            $table->timestamps();
        }); 

        Schema::create('salt_scheduletype', function($table) {
           $table->integer('salt_id')->unsigned()->index();
          
            $table->foreign('salt_id')->references('id')
                  ->on('salts')
                  ->onDelete('cascade');
           
            $table->integer('schedule_type_id')->unsigned()->index();
            
            $table->foreign('schedule_type_id')->references('id')
                  ->on('scheduletypes')
                  ->onDelete('cascade');
 
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('scheduletypes');
        Schema::drop('salt_scheduletype');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
