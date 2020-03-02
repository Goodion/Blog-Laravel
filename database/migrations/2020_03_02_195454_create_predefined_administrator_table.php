<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredefinedAdministratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predefined_administrator', function (Blueprint $table) {
            $table->string('email', 50);
        });

        DB::table('predefined_administrator')->insert(['email' => 'admin@blog.com']);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predefined_administrator');
    }
}
