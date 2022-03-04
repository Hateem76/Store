<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        
            $table->string('id_card');
            $table->string('number');
            $table->string('address');
            $table->string('account_type');
            $table->boolean('parent_child')->default(1);
            $table->unsignedBigInteger('parent_id')->default(0);
        
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
            $table->dropColumn('id_card');
            $table->dropColumn('number');
            $table->dropColumn('address');
            $table->dropColumn('account_type');
            $table->dropColumn('parent_child');
            $table->dropColumn('parent_id');
        });
    }
}
