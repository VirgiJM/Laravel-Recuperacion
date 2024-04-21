<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pis extends Model
{
    use HasFactory;
    protected $table = "pis";
    protected $fillable = ['id', 'idEdifici'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
