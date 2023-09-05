<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vara extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function comarca()
    {
        return $this->belongsTo(Comarca::class, 'comarca_id', 'id');
    }

    public function processos()
    {
        return $this->hasMany(Processo::class);
    }
}
