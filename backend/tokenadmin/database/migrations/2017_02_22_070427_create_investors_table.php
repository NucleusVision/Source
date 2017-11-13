<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->bigIncrements('investor_id');
            $table->string('id');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender', 50);
            $table->string('nationality', 100);
            $table->string('country_of_residence', 100);
            $table->string('identification_type', 100);
            $table->string('identification_number', 100);
            $table->string('document1', 100);
            $table->string('document2', 100);
            $table->enum('status', array_keys(trans('globals.investor_status')))->default('Pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::drop('investors');
    }
}
