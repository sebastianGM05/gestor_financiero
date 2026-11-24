
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Editar categoría
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Modifica la información de la categoría seleccionada.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la categoría
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            value="{{ old('nombre', $categoria->nombre) }}"
                            maxlength="150"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('nombre')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo de categoría
                        </label>

                        <select
                            name="tipo"
                            id="tipo"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="ingreso"
                                {{ old('tipo', $categoria->tipo) === 'ingreso' ? 'selected' : '' }}>
                                Ingreso
                            </option>

                            <option value="gasto"
                                {{ old('tipo', $categoria->tipo) === 'gasto' ? 'selected' : '' }}>
                                Gasto
                            </option>
                        </select>

                        @if($categoria->transacciones()->exists())
                            <p class="text-sm text-amber-600 mt-2">
                                Esta categoría tiene transacciones asociadas. Su tipo no puede modificarse.
                            </p>
                        @endif

                        @error('tipo')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            id="descripcion"
                            rows="4"
                            maxlength="255"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('descripcion', $categoria->descripcion) }}</textarea>

                        @error('descripcion')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3">

                        <a
                            href="{{ route('categorias.index') }}"
                            style="background-color: #ffffff; color: #374151; border: 1px solid #d1d5db;"
                            class="px-5 py-2 rounded-lg font-semibold hover:bg-gray-100"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            style="background-color: #4f46e5; color: #ffffff; border: 1px solid #4338ca;"
                            class="px-5 py-2 rounded-lg font-semibold shadow-sm hover:opacity-90"
                        >
                            Actualizar categoría
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

