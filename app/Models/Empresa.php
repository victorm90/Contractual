<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'IdEmpresa',
        'NEmpresa',
        'IdOrganismo',
        'Priorizada'
    ];

    protected $casts = [
        'Priorizada' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function scopePriorizadas($query)
    {
        return $query->where('Priorizada', true);
    }
}
