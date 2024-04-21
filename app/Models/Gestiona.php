<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestiona extends Model
{
    use HasFactory;
    protected $table = "gestiona";
    protected $fillable = ['id', 'idAula', 'idUsuari'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
