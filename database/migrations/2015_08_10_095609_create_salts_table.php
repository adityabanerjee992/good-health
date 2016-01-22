<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaltsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('salts', function (Blueprint $table) {
            
            $table->increments('id');
            $table->text('salt_name');
            $table->text('salt_indications')->nullable();
            $table->text('salt_dose')->nullable();
            $table->text('salt_contraindications')->nullable();
            $table->text('salt_precautions')->nullable();
            $table->text('salt_adverse_effects')->nullable();
            $table->text('salt_storage')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_salt',function(Blueprint $table)
        {
           
            $table->integer('salt_id')->unsigned()->index();
          
            $table->foreign('salt_id')->references('id')
                  ->on('salts')
                  ->onDelete('cascade');
           
            $table->integer('product_id')->unsigned()->index();
            
            $table->foreign('product_id')->references('id')
                  ->on('products')
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

        Schema::drop('salts');
        Schema::drop('product_salt');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
