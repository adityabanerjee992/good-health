<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAilmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('ailments', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('ailment_name',50)->unique();
            $table->timestamps();
        });

        Schema::create('product_ailment',function(Blueprint $table)
        {
            $table->integer('ailment_id')->unsigned()->index();
            
            $table->foreign('ailment_id')->references('id')
                  ->on('ailments')
                  ->onDelete('cascade');       
            
            $table->integer('product_id')->unsigned()->index();
            
            $table->foreign('product_id')->references('id')
                  ->on('products')
                  ->onDelete('cascade');
            
            $table->timestamps();
        }); 

        Schema::create('ailment_salt',function(Blueprint $table)
        {
            $table->integer('ailment_id')->unsigned()->index();
            
            $table->foreign('ailment_id')->references('id')
                  ->on('ailments')
                  ->onDelete('cascade');       
            
            $table->integer('salt_id')->unsigned()->index();
            
            $table->foreign('salt_id')->references('id')
                  ->on('salts')
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

            Schema::drop('ailments');
            Schema::drop('product_ailment');
            Schema::drop('ailment_salt');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
