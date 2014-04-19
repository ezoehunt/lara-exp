<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persons', function(Blueprint $table) {
			$table->increments('id');
			$table->string('bioguideid',255)->unique();
			$table->string('firstname',255);
			$table->string('middlename',255);
			$table->string('lastname',255);
			$table->string('namemod',10);
			$table->string('name',100);
			$table->string('nickname',255);
			$table->string('sortname',64);
			$table->date('birthday');
			$table->integer('gender');
			$table->string('religion');
			$table->string('twitterid',50);
			$table->string('facebookid',255);
			$table->string('youtubeid',255);
			$table->string('wikipediaid',255);
			$table->string('govtrackid',50);
			$table->string('pvsid',50);
			$table->string('osid',50);
			$table->integer('cspanid');
			$table->string('maplightid',50);
			$table->string('lisid',50);
			$table->text('fec');
			$table->string('wapoid',50);
			$table->string('icpsrid',50);
			$table->string('icpsrprezid',50);
			$table->string('execflag', 10);
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
		Schema::drop('persons');
	}

}
