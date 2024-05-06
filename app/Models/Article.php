<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = "article";
    protected $fillable = ['id', 'dataalta', 'marca', 'model', 'descripcio', 'databaixa', 'familiaId', 'aulaId', 'documentEntradaId'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
