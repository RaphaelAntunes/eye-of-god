<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortModel extends Model
{
    protected $table = 'shortlink';
    protected $fillable = [
        'id',
        'link',
        'shortlink',
        'open'
    ];
    public $timestamps = false; // Desabilita as colunas de data e hora

}
