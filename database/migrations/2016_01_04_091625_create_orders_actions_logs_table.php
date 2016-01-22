<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersActionsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_actions_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('user_role')->nullable();
            $table->text('description')->nullable();

            $table->foreign('order_id')
                 ->references('id')
                 ->on('orders')
                 ->onDelete('cascade');

            $table->foreign('user_id')
                 ->references('id')
                 ->on('users');

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
        Schema::drop('orders_actions_logs');
    }
}
