<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuenta extends Model
{
    use HasFactory;

    protected $table = 'cuentas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'saldo',
        'moneda',
    ];

    protected $casts = [
        'saldo' => 'decimal:2',
    ];

    public function transacciones(): HasMany
    {
        return $this->hasMany(Transaccion::class);
    }
}
