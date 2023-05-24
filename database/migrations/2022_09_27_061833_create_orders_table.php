<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('carts', function (Blueprint $table) {
        //     $table->unsignedBigInteger('user_id')->after('id');
        // });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_paid')->default(0);
            $table->tinyInteger('is_favorite')->default(0);
            $table->tinyInteger('times')->default(0);
            $table->tinyInteger('delivery_time')->default("any_time");
            $table->bigInteger('number');
            $table->double('total', 15, 8)->default(00.00);
            $table->text('location');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
