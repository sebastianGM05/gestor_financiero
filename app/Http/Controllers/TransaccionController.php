<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cuenta;
use App\Models\Transaccion;
use App\Services\MovimientoService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransaccionController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::with(['cuenta', 'categoria'])
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->paginate(10);

        return view('transacciones.index', compact('transacciones'));
    }

    public function create()
    {
        $cuentas = Cuenta::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('transacciones.create', compact('cuentas', 'categorias'));
    }

    public function store(Request $request, MovimientoService $movimientoService)
    {
        $datos = $this->validarDatos($request);

        $datos['creado_por'] = $request->user()->name;

        $movimientoService->crear($datos);

        return redirect()
            ->route('transacciones.index')
            ->with('success', 'Transacción registrada correctamente.');
    }

    public function edit(Transaccion $transaccion)
    {
        $cuentas = Cuenta::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('transacciones.edit', compact(
            'transaccion',
            'cuentas',
            'categorias'
        ));
    }

    public function update(
        Request $request,
        Transaccion $transaccion,
        MovimientoService $movimientoService
    ) {
        $datos = $this->validarDatos($request);

        $movimientoService->actualizar($transaccion, $datos);

        return redirect()
            ->route('transacciones.index')
            ->with('success', 'Transacción actualizada correctamente.');
    }

    public function destroy(
        Transaccion $transaccion,
        MovimientoService $movimientoService
    ) {
        $movimientoService->eliminar($transaccion);

        return redirect()
            ->route('transacciones.index')
            ->with('success', 'Transacción eliminada correctamente.');
    }

    private function validarDatos(Request $request): array
    {
        $datos = $request->validate([
            'cuenta_id' => [
                'required',
                'integer',
                Rule::exists('cuentas', 'id'),
            ],
            'categoria_id' => [
                'required',
                'integer',
                Rule::exists('categorias', 'id'),
            ],
            'tipo' => [
                'required',
                Rule::in(['ingreso', 'gasto']),
            ],
            'monto' => [
                'required',
                'numeric',
                'gt:0',
                'decimal:0,2',
            ],
            'fecha' => [
                'required',
                'date',
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $categoria = Categoria::findOrFail($datos['categoria_id']);

        if ($categoria->tipo !== $datos['tipo']) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'categoria_id' => 'La categoría seleccionada no corresponde al tipo de transacción.',
            ]);
        }

        return $datos;
    }
}
