<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarBukti extends Model
{
    use HasFactory;
    protected $fillable = ['hasil_suara_id', 'path'];
}
