<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documententrada extends Model
{
    use HasFactory;
    protected $table = "documententrada";
    protected $fillable = ['id', 'data', 'observacions', 'ref', 'url_pdf', 'proveeidorId'];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
