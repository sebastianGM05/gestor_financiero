
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Gestión de categorías
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Organiza tus ingresos y gastos.
                </p>
            </div>

            <a href="{{ route('categorias.create') }}"
               style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 18px; background-color: #4f46e5; color: #ffffff; border: 1px solid #4338ca; border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none;">
                Nueva categoría
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-5 p-4 rounded-lg bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 p-4 rounded-lg bg-red-100 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Categorías registradas
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total de categorías: {{ $categorias->total() }}
                    </p>
                </div>

                @if($categorias->isEmpty())
                    <div class="p-10 text-center">
                        <h4 class="text-lg font-semibold text-gray-700">
                            No hay categorías registradas
                        </h4>
                        <p class="text-sm text-gray-500 mt-2">
                            Registra tu primera categoría para comenzar.
                        </p>

                        <a href="{{ route('categorias.create') }}"
                           style="display: inline-block; margin-top: 20px; padding: 10px 18px; background-color: #4f46e5; color: #ffffff; border: 1px solid #4338ca; border-radius: 8px; text-decoration: none; font-weight: 600;">
                            Crear categoría
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Nombre
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Tipo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Descripción
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($categorias as $categoria)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $categoria->nombre }}
                                        </td>

                                        <td class="px-6 py-4 text-sm">
                                            @if($categoria->tipo === 'ingreso')
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                    Ingreso
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                    Gasto
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $categoria->descripcion ?: 'Sin descripción' }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center items-center gap-3">
                                                <a href="{{ route('categorias.edit', $categoria) }}"
                                                   style="color: #4f46e5; font-weight: 600; font-size: 14px; text-decoration: none;">
                                                    Editar
                                                </a>

                                                <form action="{{ route('categorias.destroy', $categoria) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            style="color: #dc2626; background-color: transparent; border: none; cursor: pointer; font-weight: 600; font-size: 14px;">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 border-t border-gray-100">
                        {{ $categorias->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

