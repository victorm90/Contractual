<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Representante extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'representantes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'contrato_id',
        'CIdentidad',
        'NRepresentante',
        'Activo',
        'CargoRepresentante',
        'user_id'
    ];

    protected $casts = [
        'Activo' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * Relación con el contrato
     */
    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    /**
     * Relación con el usuario asociado
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener representantes activos
     */
    public function scopeActivos($query)
    {
        return $query->where('Activo', true);
    }

    /**
     * Buscar por cédula de identidad
     */
    public function scopePorCedula($query, $cedula)
    {
        return $query->where('CIdentidad', $cedula);
    }
}
