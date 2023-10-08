<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    protected $table = 'vip_key';
    protected $fillable = [
        'chave','email_ativo','data_ativo'
    ];    public $timestamps = false; // Desabilita as colunas de data e hora
}
