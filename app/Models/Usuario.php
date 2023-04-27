<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_usuarios';

    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];
    protected $dates = ['deleted_at'];
}
