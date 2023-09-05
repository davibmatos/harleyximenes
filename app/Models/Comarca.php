<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comarca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function varas()
    {
        return $this->hasMany(Vara::class, 'comarca_id', 'id');
    }

    public function processos()
    {
        return $this->hasMany(Processo::class);
    }
}
