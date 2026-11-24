<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nombre')->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'tipo' => ['required', Rule::in(['ingreso', 'gasto'])],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        Categoria::create($datos);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría registrada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'tipo' => [
                'required',
                Rule::in(['ingreso', 'gasto']),
                Rule::in(
                    $categoria->transacciones()->exists()
                        ? [$categoria->tipo]
                        : ['ingreso', 'gasto']
                ),
            ],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        $categoria->update($datos);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->transacciones()->exists()) {
            return redirect()
                ->route('categorias.index')
                ->with('error', 'No se puede eliminar una categoría que tiene transacciones asociadas.');
        }

        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
