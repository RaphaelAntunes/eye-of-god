<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('free_test_user', function (Blueprint $table) {
            $table->id(); // 1 - id Primária
            $table->string('nome', 255); // 2 - nome varchar(255)
            $table->string('email', 255); // 3 - email varchar(255)
            $table->string('senha', 255); // 4 - senha varchar(255)
            $table->string('telefone', 255); // 5 - telefone varchar(255)
            $table->string('ip', 255); // 6 - ip varchar(255)
            $table->integer('qtdconsultas')->default(0); // 7 - qtdconsultas int(255)
            $table->string('pro', 100); // 8 - pro varchar(100)
            $table->string('chave', 255); // 9 - chave varchar(255)
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('free_test_user');
    }
};
