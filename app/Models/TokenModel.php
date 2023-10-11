<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

                            class TokenModel extends Model
                            {
                                protected $table = 'token';
                                protected $fillable = [
                                    'token',
                                ];    public $timestamps = false; // Desabilita as colunas de data e hora
                            }
