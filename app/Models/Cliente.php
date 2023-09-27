<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'telefone2',
        'funcao',
        'email',
        'salario',
    ];

    public function documentos()
    {
        return $this->morphMany(Documento::class, 'documentoable');
    }

    
}
