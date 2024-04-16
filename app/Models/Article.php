<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'dataalta', 'marca', 'model', 'descripcio', 'databaixa', 'idFamilia', 'idAula', 'idDocumentEntrada'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
