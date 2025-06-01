<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contrato extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contratos';

    protected $fillable = [
        'nombre_cliente',
        'descripcion',
        'clas_legal_id',
        'empresa_id',
        'provincia_id',
        'municipio_id',
        'forma_pago_id',
        'user_id',
        'direccion',
        'email',
        'telefono',
        'representante_legal',
        'cod_reuup',
        'codigo_nit',
        'cta_bancaria',
        'sucursal_credito',
        'fecha_firmado',
        'fecha_vencimiento',
        'vigencia',
        'termino_pago',
        'monto_total',
        'moneda',
        'activo',
        'estado',
        'dias_renovacion_aviso',
        'archivo_path',
        'archivo_mime',
        'observaciones',
        'last_updated_by'
    ];

    protected $casts = [
        'fecha_firmado' => 'date',
        'fecha_vencimiento' => 'date',
        'monto_total' => 'decimal:2',
        'activo' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    // Generación automática de número de contrato
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $datePart = now()->format('Ymd');
            $lastContract = self::where('numero_contrato', 'like', $datePart . '-%')
                ->orderBy('numero_contrato', 'desc')
                ->first();

            $sequence = $lastContract ? (int)Str::after($lastContract->numero_contrato, '-') + 1 : 1;
            $model->numero_contrato = $datePart . '-' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
        });
    }

    // Relaciones
    public function clasLegal()
    {
        return $this->belongsTo(ClasLegal::class, 'clas_legal_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormPago::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actualizadoPor()
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    // Scopes útiles
    public function scopeVigentes($query)
    {
        return $query->where('estado', 'VIGENTE');
    }

    public function scopePorVencer($query, $days = 30)
    {
        return $query->where('fecha_vencimiento', '<=', now()->addDays($days))
            ->where('estado', 'VIGENTE');
    }

    public function scopeDeEmpresa($query, $empresaId)
    {
        return $query->where('empresa_id', $empresaId);
    }
}
