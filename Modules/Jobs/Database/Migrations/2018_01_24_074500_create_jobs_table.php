<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('description');
            $table->string('postcode');
            $table->dateTime('starts');
            $table->dateTime('ends');
            $table->integer('rating')->default(0);
            $table->double('offer')->default(8);

            $table->integer('company_id')->unsigned();
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->boolean('completed')->default(false); // i.e. job is done and completed
            $table->dateTime('completed_at')->nullable();

            $table->boolean('paid')->default(false); // i.e. job has been paid for
            $table->dateTime('paid_at')->nullable();

            $table->longText('metadata')->nullable();

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
        Schema::dropIfExists('jobs');
    }
}
