<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user', 'customer', 'panel'];

    public function panel()
    {
        return $this->belongsTo(panel::class);
    }
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
