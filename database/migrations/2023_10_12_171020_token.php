<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('token', function (Blueprint $table) {
            $table->string('token', 1024); // token varchar(1024)
            $table->id(); // 2 - id Primária
        });
    }

    public function down()
    {
        Schema::dropIfExists('token');
    }
};
