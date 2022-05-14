<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug');
            $table->integer('shares')->default(0);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->on('users')->references('id')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            if(Schema::hasColumn('posts', 'slug')){
                $table->dropColumn('slug');
            }
            if(Schema::hasColumn('posts', 'shares')){
                $table->dropColumn('shares');
            }
            if(Schema::hasColumn('posts', 'user_id')){
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};