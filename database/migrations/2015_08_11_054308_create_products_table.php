<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      
      Schema::create('products', function (Blueprint $table) {
            
            $table->increments('id');   
        
            $table->string('product_code',20)->unique();
            $table->text('product_name');
            $table->string('is_prescription_drug',50)->default('NO');
            $table->float('product_mrp')->nullable();
            $table->float('product_tax')->nullable();
            $table->softDeletes();
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

        Schema::drop('products');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
