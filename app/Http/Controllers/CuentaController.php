<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::withCount('transacciones')
            ->orderBy('nombre')
            ->paginate(10);

        return view('cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        return view('cuentas.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'saldo' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'moneda' => ['required', 'string', 'max:10'],
        ]);

        Cuenta::create($datos);

        return redirect()
            ->route('cuentas.index')
            ->with('success', 'Cuenta registrada correctamente.');
    }

    public function edit(Cuenta $cuenta)
    {
        return view('cuentas.edit', compact('cuenta'));
    }

    public function update(Request $request, Cuenta $cuenta)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'moneda' => ['required', 'string', 'max:10'],
        ]);

        $cuenta->update($datos);

        return redirect()
            ->route('cuentas.index')
            ->with('success', 'Cuenta actualizada correctamente.');
    }

    public function destroy(Cuenta $cuenta)
    {
        if ($cuenta->transacciones()->exists()) {
            return redirect()
                ->route('cuentas.index')
                ->with('error', 'No se puede eliminar una cuenta que tiene transacciones asociadas.');
        }

        $cuenta->delete();

        return redirect()
            ->route('cuentas.index')
            ->with('success', 'Cuenta eliminada correctamente.');
    }
}
