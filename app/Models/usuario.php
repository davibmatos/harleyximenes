<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function processos()
    {
        return $this->hasMany(Processo::class, 'adv_id');
    }
}
