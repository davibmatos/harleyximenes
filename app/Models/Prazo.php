<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prazo extends Model
{
    use HasFactory;

    protected $fillable = [
        'processo_id',
        'data_ini',
        'data_fim',
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class, 'num_processo', 'id');
    }
}
