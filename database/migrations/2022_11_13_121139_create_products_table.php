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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->integer('type');
            //@todo extract balance to entity
            $table->integer('start_balance_amount');
            $table->string('start_balance_currency');
            $table->integer('balance_amount');
            $table->string('balance_currency');
            $table->foreignUuid('user_id')->constrained('users');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\User::class);
        });
        Schema::dropIfExists('products');
    }
};
