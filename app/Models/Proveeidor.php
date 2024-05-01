<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveeidor extends Model
{
    use HasFactory;
    protected $table = "proveeidor";
    protected $fillable = ['id', 'nom', 'nif', 'email', 'telefon'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
