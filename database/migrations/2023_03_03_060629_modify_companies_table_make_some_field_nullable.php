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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('about')->nullable()
                ->change();
            $table->string('address')->nullable()
                ->change();
            $table->string('phone_number')->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('about')->nullable(false)
                ->change();
            $table->string('address')->nullable(false)
                ->change();
            $table->string('phone_number')->nullable(false)
                ->change();
        });
    }
};
