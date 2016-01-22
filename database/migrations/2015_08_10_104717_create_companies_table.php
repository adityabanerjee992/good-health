<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('companies', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('company_name',100)->unique();
            $table->timestamps();
        });

        Schema::create('product_company',function(Blueprint $table)
        {
 
            $table->integer('company_id')->unsigned()->index();
          
            $table->foreign('company_id')->references('id')
                  ->on('companies')
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

        Schema::drop('companies');
        Schema::drop('product_company');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
