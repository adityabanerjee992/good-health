<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      Schema::create('documents', function (Blueprint $table) {
        $table->increments('id');
        $table->string('patient_name');
        $table->string('document_name',255);
        $table->string('document_original_name',255);
        $table->string('document_type',50);
        $table->string('document_storage_path',255);
        $table->text('document_notes');
        $table->integer('order_id')->unsigned()->nullable();
        $table->integer('customer_id')->unsigned()->nullable();
        $table->date('prescription_date');
        $table->timestamps();

            // $table->foreign('order_id')
            //   ->references('id')->on('orders');

            // $table->foreign('customer_id')
            //   ->references('id')->on('customers');
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
      Schema::drop('documents');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
  }
}
