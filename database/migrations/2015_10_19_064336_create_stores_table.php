<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
  
        Schema::create('stores', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name',100);
            $table->string('owner_name',100);
            $table->text('address');
            $table->string('city',100);
            $table->string('state',100);
            $table->string('country',100)->default('India');
            $table->string('primary_mobile_number',20);
            $table->string('alternate_mobile_number',20)->nullable();
            $table->string('email',50);
            $table->timestamps();
            $table->softDeletes();
         
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        Schema::create('pincodes', function($table) {
            $table->increments('id');
            $table->integer('pincode')->nullable();
            $table->timestamps();
        });

        Schema::create('store_pincode', function($table) {

            $table->integer('store_id')->unsigned()->index();
            
            $table->foreign('store_id')->references('id')
                  ->on('stores')
                  ->onDelete('cascade');       
            
            $table->integer('pincode_id')->unsigned()->index();
            
            $table->foreign('pincode_id')->references('id')
                  ->on('pincodes')
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
        
        Schema::drop('store_pincode');
        Schema::drop('pincodes');
        Schema::drop('stores');

       DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
