<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->string('phone',20)->unique()->nullable();
            $table->string('api_key',100)->nullable();
            $table->string('password', 60); 
            $table->integer('account_status')->default(1); // 1 is for active , 0 is for suspended
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('customers');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
