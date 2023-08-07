<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'processo_id',
        'data_aud',
        'id_cliente',
        'id_empresas',
    ];

    public function cliente() 
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function empresa() 
    {
        return $this->belongsTo(Empresa::class, 'id_empresas');
    }

    public function processo() 
    {
        return $this->belongsTo(Processo::class, 'processo_id');
    }
}
