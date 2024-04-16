<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveeidor extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nom', 'email', 'nif', 'telefon'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
