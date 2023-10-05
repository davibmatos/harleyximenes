<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoEmpresa extends Model
{
    protected $fillable = ['nome_arquivo', 'tipo', 'empresa_id', 'nome_documento'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoEmpresa::class);
    }
}
