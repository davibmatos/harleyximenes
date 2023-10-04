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
        'data_aud',
        'hora_aud',
        'tipo_aud',
        'acordo',
        'valor_total',
        'qtd_parcelas',
        'vencimentos'
    ];

    public function anexos()
    {
        return $this->hasMany(Anexo::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function vara()
    {
        return $this->belongsTo(Vara::class);
    }

    public function comarca()
    {
        return $this->belongsTo(Comarca::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'adv_id');
    }

    public function advogados()
    {
        return $this->belongsToMany(Usuario::class, 'advogado_processo', 'processo_id', 'advogado_id');
    }

    public function usuarioCadastrante()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
