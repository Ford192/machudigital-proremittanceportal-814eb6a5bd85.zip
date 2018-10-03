<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project'); // Dropdown of Project details
            
            $table->string('change_requester'); //Person requesting for change [Auto filled with Login Name]
            $table->integer('user_id');
            $table->string('change_num');   // Receipt Number
            $table->longText('describe_change')->nullable(); //Change Description
            $table->longText('describe_reason')->nullable(); //Reason for the change 
            $table->longText('describe_tech_changes')->nullable(); //Where the tech team inserts the changes to be made. [filled only by tech role]
            $table->longText('describe_risk')->nullable(); //Where the tech team inserts the risks associated. [filled only by tech role]
            $table->longText('describe_quality')->nullable(); //Where the tech team implications to quality. [filled only by tech role]
            $table->integer('disposition')->default(false); //Where the Tech team & MD Approve/Reject/Defer. [filled only by tech & MD role]
            $table->longText('justification')->nullable(); //Where the tech team & MD inserts their justification. [filled only by tech & MD role]
            $table->integer('isEmployer')->default(false); //to check which user endorsed it
            $table->integer('isTech')->default(false); //to check which user endorsed it
            $table->integer('isAdmin')->default(false); //to check which user endorsed it

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
        Schema::dropIfExists('cruds');
    }
}
