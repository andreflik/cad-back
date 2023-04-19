<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use SoftDeletes;

    protected $table = 'cad_pessoas';
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'sexo',
        'cidade',
        'uf'
    ];
    protected $dates = ['deleted_at'];
}
