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
        Schema::create('oportunidades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('cliente_id');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('produto_id');
            $table->foreign('produto_id')
                ->references('id')
                ->on('produtos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->enum('status', ['perdida', 'vencida'])->nullable();

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
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);    
            $table->dropForeign(['cliente_id']);    
            $table->dropForeign(['produto_id']);    
        });
        Schema::dropIfExists('oportunidades');
    }
};
