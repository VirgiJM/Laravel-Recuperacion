<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'idEdifici', 'idPis'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
