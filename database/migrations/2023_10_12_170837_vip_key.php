<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vip_key', function (Blueprint $table) {
            $table->id(); // 1 - id Primária
            $table->string('chave', 255); // 2 - chave varchar(255)
            $table->string('email_ativo', 255); // 3 - email_ativo varchar(255)
            $table->string('data_ativo', 255); // 4 - data_ativo varchar(255)

        });
    }

    public function down()
    {
        Schema::dropIfExists('vip_key');
    }
};
