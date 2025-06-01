<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormPago extends Model
{
   use HasFactory, SoftDeletes;

    protected $table = 'form_pagos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'descripcion',
        'requiere_referencia',
        'requiere_banco',
        'dias_clearing',
        'activo',
        'observaciones'
    ];

    protected $casts = [
        'requiere_referencia' => 'boolean',
        'requiere_banco' => 'boolean',
        'activo' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

}
