<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['nome_arquivo', 'tipo', 'documentoable_id', 'documentoable_type'];

    public function documentoable()
    {
        return $this->morphTo();
    }
}
