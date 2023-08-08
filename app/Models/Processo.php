<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'usuario_id',
        'vara_id',
        'empresa_id',
        'cliente_id',
        'comarca_id',
    ];

    public function anexos()
    {
        return $this->hasMany(Anexo::class);
    }
}
