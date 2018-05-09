<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration { 

    public function up() {
        Schema::create('users', function (Blueprint $table) { 
            $table->increments('id');
            $table->timestamps();
            $table->string('email');
            $table->string('password'); 
            // $table->boolean('online'); 
            $table->rememberToken();
        });
    }
 
	public function down() {
        Schema::drop('users');
    } 
}