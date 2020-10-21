<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsBackendRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('cms_backend_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('is_super');
            $table->timestamps();
        });
          \DB::table('cms_backend_roles')->insert(
                [
                    'name' => 'Super Admin', 
                    'is_super' => 1,
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
        Schema::dropIfExists('cms_backend_roles');
    }
}
