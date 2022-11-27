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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('type');
            $table->foreignUuid('product_id')->constrained('products');
            $table->foreignUuid('category_id')->constrained('categories');
            $table->foreignUuid('user_id')->constrained('users');
            $table->integer('amount_amount');
            $table->string('amount_currency');
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\Product::class);
            $table->dropConstrainedForeignIdFor(\App\Models\Category::class);
            $table->dropConstrainedForeignIdFor(\App\Models\User::class);
        });
        Schema::dropIfExists('transactions');
    }
};
