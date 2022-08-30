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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendedor_id');
            $table->foreign('vendedor_id')
                ->references('id')
                ->on('vendedores')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('nome');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign(['vendedor_id']);    
        });

        Schema::dropIfExists('clientes');
    }
};
