<?php

namespace App\Services;

use App\Models\Cuenta;
use App\Models\Transaccion;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MovimientoService
{
    public function crear(array $datos): Transaccion
    {
        return DB::transaction(function () use ($datos) {
            $cuenta = Cuenta::whereKey($datos['cuenta_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $this->validarSaldo($cuenta, $datos['tipo'], $datos['monto']);

            $this->aplicarMovimiento(
                $cuenta,
                $datos['tipo'],
                $datos['monto']
            );

            return Transaccion::create($datos);
        });
    }

    public function actualizar(Transaccion $transaccion, array $datos): Transaccion
    {
        return DB::transaction(function () use ($transaccion, $datos) {
            $transaccion = Transaccion::whereKey($transaccion->id)
                ->lockForUpdate()
                ->firstOrFail();

            $ids = collect([
                $transaccion->cuenta_id,
                $datos['cuenta_id'],
            ])->unique()->sort()->values();

            $cuentas = Cuenta::whereIn('id', $ids)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $cuentaAnterior = $cuentas->get($transaccion->cuenta_id);
            $cuentaNueva = $cuentas->get($datos['cuenta_id']);

            $this->revertirMovimiento(
                $cuentaAnterior,
                $transaccion->tipo,
                $transaccion->monto
            );

            $this->validarSaldo(
                $cuentaNueva,
                $datos['tipo'],
                $datos['monto']
            );

            $this->aplicarMovimiento(
                $cuentaNueva,
                $datos['tipo'],
                $datos['monto']
            );

            $transaccion->update($datos);

            return $transaccion->fresh();
        });
    }

    public function eliminar(Transaccion $transaccion): void
    {
        DB::transaction(function () use ($transaccion) {
            $transaccion = Transaccion::whereKey($transaccion->id)
                ->lockForUpdate()
                ->firstOrFail();

            $cuenta = Cuenta::whereKey($transaccion->cuenta_id)
                ->lockForUpdate()
                ->firstOrFail();

            $this->revertirMovimiento(
                $cuenta,
                $transaccion->tipo,
                $transaccion->monto
            );

            $transaccion->delete();
        });
    }

    private function validarSaldo(
        Cuenta $cuenta,
        string $tipo,
        float|string $monto
    ): void {
        if ($tipo === 'gasto' && (float) $monto > (float) $cuenta->saldo) {
            throw ValidationException::withMessages([
                'monto' => 'El gasto no puede superar el saldo disponible de la cuenta.',
            ]);
        }
    }

    private function aplicarMovimiento(
        Cuenta $cuenta,
        string $tipo,
        float|string $monto
    ): void {
        if ($tipo === 'ingreso') {
            $cuenta->saldo = (float) $cuenta->saldo + (float) $monto;
        } else {
            $cuenta->saldo = (float) $cuenta->saldo - (float) $monto;
        }

        $cuenta->save();
    }

    private function revertirMovimiento(
        Cuenta $cuenta,
        string $tipo,
        float|string $monto
    ): void {
        if ($tipo === 'ingreso') {
            $cuenta->saldo = (float) $cuenta->saldo - (float) $monto;
        } else {
            $cuenta->saldo = (float) $cuenta->saldo + (float) $monto;
        }

        $cuenta->save();
    }
}
