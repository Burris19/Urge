<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Table Users
		Schema::create('users', function(Blueprint $table)
		{				
			$table->increments('id');
			$table->string('email');
			$table->string('username')->unique();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('password', 60);
			$table->enum('type',['admin','user']);
			$table->rememberToken();
			$table->timestamps();
		});

		//Table States
		Schema::create('states', function(Blueprint $table)
		{				
			$table->increments('id');
			$table->string('towns');
			$table->string('description');
			$table->string('observation');			
			$table->timestamps();
		});

		//Table Procedures
		Schema::create('procedures', function(Blueprint $table)
		{				
			$table->increments('id');
			$table->string('description');
			$table->timestamps();
		});

		//Table Notices
		Schema::create('notices', function(Blueprint $table)
		{				
			$table->increments('id');
			$table->string('image');
			$table->string('title');
			$table->string('description');
			$table->string('tags');
			$table->integer('iduser')->unsigned();
			$table->foreign('iduser')
				->references('id')
				->on('users');
			$table->timestamps();
		});

        //Table Category Guides
        Schema::create('categoryguides', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('description'); 
            $table->integer('iduser')->unsigned();
            $table->foreign('iduser')
                ->references('id')
                ->on('users');         
            $table->timestamps();
        });

        //Table Guides
        Schema::create('guides', function(Blueprint $table)
      	{
	        $table->increments('id');
	        $table->string('description');
	        $table->integer('iduser')->unsigned();        
	        $table->foreign('iduser')
	            ->references('id')
	            ->on('users');                    
	        $table->integer('idcategoryguide')->unsigned();
	        $table->foreign('idcategoryguide')
	            ->references('id')
	            ->on('categoryguides');            
	        $table->timestamps();
        });
        		//Table Guide Procedures
		Schema::create('guideprocedures', function(Blueprint $table)
        { 
            $table->increments('id');
            $table->integer('idguide')->unsigned();
            $table->foreign('idguide')
                 ->references('id')
                 ->on('guides');
            $table->integer('idprocedure')->unsigned();
            $table->foreign('idprocedure')
                 ->references('id')
                 ->on('procedures');                 
            $table->boolean('isenabled');         
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
		Schema::drop('users');
		Schema::drop('states');
		Schema::drop('states');
		Schema::drop('notices');
		Schema::drop('guideprocedures'); 
		Schema::drop('categoryguides'); 
		Schema::drop('guides'); 
	}

}
