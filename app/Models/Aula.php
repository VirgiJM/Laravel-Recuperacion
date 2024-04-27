<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $table = "aula";
    protected $fillable = ['id', 'codiAula'/*'idEdifici'*/, 'pisId', 'descripcio'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
