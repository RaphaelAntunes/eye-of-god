<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model
{
    protected $table = 'eye';
    public $timestamps = false; // Desabilita as colunas de data e hora

}
