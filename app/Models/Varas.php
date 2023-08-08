<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function comarca()
    {
        return $this->belongsTo(Comarca::class, 'comarca_id', 'id');
    }
}
