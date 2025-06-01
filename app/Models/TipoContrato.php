<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    protected $table = 'tipos_contrato';
    
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class);
    }
}
