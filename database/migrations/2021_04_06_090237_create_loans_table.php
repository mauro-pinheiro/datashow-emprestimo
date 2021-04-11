<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('client_id');
            $table->foreignId('equipament_id');
            $table->timestamp('reservation_date');              //Date que o equipamento foi reservado
            $table->timestamp('load_date')->nullable();         //Data de retirada do equipamento
            $table->timestamp('due_date')->nullable();          //Data de que o equipamento deve ser devolvido
            $table->timestamp('return_date')->nullable();       //Data que o equipamento foi devolvido
            $table->string('status');
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
        Schema::dropIfExists('loans');
    }
}
