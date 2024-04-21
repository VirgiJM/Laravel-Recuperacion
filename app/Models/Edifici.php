<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edifici extends Model
{
    use HasFactory;
    protected $table = "edifici";
    protected $fillable = ['id', 'descripcio'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
