<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'abreviatura'
    ];

    protected $casts = [
        'codigo' => 'string',
        'abreviatura' => 'string',
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }   

    /**
     * Accesor para mostrar el nombre formateado
     */
    public function getNombreFormateadoAttribute(): string
    {
        return ucwords(strtolower($this->nombre));
    }

    /**
     * Accesor para mostrar la provincia completa
     */
    public function getProvinciaCompletaAttribute(): string
    {
        return "{$this->nombre} ({$this->codigo})";
    }
}
