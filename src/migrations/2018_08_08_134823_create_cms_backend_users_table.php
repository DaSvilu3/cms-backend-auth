<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsBackendUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cms_backend_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('role_id');
            $table->string('email')->unique();
            $table->string('reset_password_token', 100)->nullable();
            $table->dateTime('reset_token_at')->nullable();
            $table->string('password');
            $table->integer('image_id');
            $table->integer('is_active')->nullable();

            $table->timestamps();
        });
        \DB::table('cms_backend_users')->insert(
                [
                    'name' => 'admin', 
                    'email' => 'admin@admin.com', 
                    'role_id' => '1', 
                    'password' => md5('admin'), 
                    'image_id' => '1', 
                    'is_active' => 1,
                    ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_backend_users');
    }
}
