<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freetestModel extends Model
{
    protected $table = 'free_test_user';
    protected $fillable = [
        'nome','email','ip','qtdconsultas','telefone','senha'
    ];    public $timestamps = false; // Desabilita as colunas de data e hora

}

class logModel extends Model
{
    protected $table = 'logs_busca';
    protected $fillable = [
        'conta','ip','placa',
    ];    public $timestamps = false; // Desabilita as colunas de data e hora

}
