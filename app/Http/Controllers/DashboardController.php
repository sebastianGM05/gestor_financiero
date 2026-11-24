<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cuenta;
use App\Models\Transaccion;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $saldoTotal = Cuenta::sum('saldo');

        $totalIngresos = Transaccion::where('tipo', 'ingreso')
            ->sum('monto');

        $totalGastos = Transaccion::where('tipo', 'gasto')
            ->sum('monto');

        $cantidadCuentas = Cuenta::count();

        $cantidadCategorias = Categoria::count();

        $cantidadTransacciones = Transaccion::count();

        $ultimasTransacciones = Transaccion::with([
            'cuenta',
            'categoria',
        ])
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        $movimientosMensuales = Transaccion::select(
            'tipo',
            DB::raw('SUM(monto) as total')
        )
            ->whereYear('fecha', now()->year)
            ->whereMonth('fecha', now()->month)
            ->groupBy('tipo')
            ->get()
            ->keyBy('tipo');

        $ingresosMes = $movimientosMensuales->get('ingreso')->total ?? 0;

        $gastosMes = $movimientosMensuales->get('gasto')->total ?? 0;

        return view('dashboard', compact(
            'saldoTotal',
            'totalIngresos',
            'totalGastos',
            'cantidadCuentas',
            'cantidadCategorias',
            'cantidadTransacciones',
            'ultimasTransacciones',
            'ingresosMes',
            'gastosMes'
        ));
    }
}
