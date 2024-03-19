<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class logModel extends Model
{
    protected $table = 'logs_busca';
    protected $fillable = [
        'conta','ip','placa',
    ];    public $timestamps = false; // Desabilita as colunas de data e hora

}
