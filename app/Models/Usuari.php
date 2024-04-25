<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuari extends Model
{
    use HasFactory;
    protected $table = "usuari";
    protected $fillable = ['id', 'nom', 'email', 'contrasenya', 'telefon'];
    protected $hidden = ['created_at', 'validat', 'updated_at', 'remember_token', 'contrasenya'];
}
