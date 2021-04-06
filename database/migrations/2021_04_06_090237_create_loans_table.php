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
            $table->timestamp('due_date');
            $table->timestamp('return_date')->nullable();
            $table->string('status')->virtualAs("
                CASE
                    WHEN return_data IS NOT NULL THEN 'Devolvido'
                    WHEN NOW() > due_date THEN 'Atrasado'
                    ELSE 'Emprestado'
                ");
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
