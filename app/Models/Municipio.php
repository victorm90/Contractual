<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'codigo_provincia',
        'provincia_id'
    ];

    /**
     * Relación con la provincia
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    /**
     * Accesor para nombre formateado
     */
    public function getNombreFormateadoAttribute(): string
    {
        return ucwords(mb_strtolower($this->nombre));
    }

    /**
     * Accesor para nombre completo (municipio - provincia)
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre_formateado} - {$this->provincia->nombre_formateado}";
    }
}
