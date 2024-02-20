<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivitiesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('shinomontazh')->default(false);
            $table->boolean('sto')->default(false);
            $table->boolean('diagnostika')->default(false);
            $table->boolean('remont_mkpp_akpp')->default(false);
            $table->boolean('remont_dvigatelya')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['shinomontazh', 'sto', 'diagnostika', 'remont_mkpp_akpp', 'remont_dvigatelya']);
        });
    }
}
