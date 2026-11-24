
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Editar cuenta
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Modifica la información de la cuenta seleccionada.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <form action="{{ route('cuentas.update', $cuenta) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la cuenta
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            value="{{ old('nombre', $cuenta->nombre) }}"
                            maxlength="150"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('nombre')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            id="descripcion"
                            rows="3"
                            maxlength="255"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('descripcion', $cuenta->descripcion) }}</textarea>

                        @error('descripcion')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="moneda" class="block text-sm font-medium text-gray-700 mb-2">
                            Moneda
                        </label>

                        <select
                            name="moneda"
                            id="moneda"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="COP" {{ old('moneda', $cuenta->moneda) === 'COP' ? 'selected' : '' }}>
                                COP - Peso colombiano
                            </option>
                        </select>

                        @error('moneda')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 rounded-lg bg-blue-50 border border-blue-100 p-4">
                        <p class="text-sm text-blue-800">
                            Saldo actual:
                            <strong>${{ number_format((float) $cuenta->saldo, 2, ',', '.') }}</strong>
                        </p>
                        <p class="text-xs text-blue-700 mt-1">
                            El saldo se modifica mediante las transacciones, no desde este formulario.
                        </p>
                    </div>

                    <div class="flex items-center justify-end gap-3">

                        <a
                            href="{{ route('cuentas.index') }}"
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
                            Actualizar cuenta
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
