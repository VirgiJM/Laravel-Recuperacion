<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;
    protected $table = "familia";
    protected $fillable = ['id', 'nom'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
