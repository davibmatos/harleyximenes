<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'telefone2',
        'email',
    ];

    public function documentoEmpresas()
    {
        return $this->hasMany(DocumentoEmpresa::class);
    }
}
