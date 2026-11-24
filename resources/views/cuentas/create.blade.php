
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Nueva cuenta
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Registra una cuenta para administrar tu dinero.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <form action="{{ route('cuentas.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la cuenta
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            value="{{ old('nombre') }}"
                            maxlength="150"
                            required
                            placeholder="Ejemplo: Cuenta principal"
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
                            placeholder="Descripción de la cuenta (opcional)"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="saldo" class="block text-sm font-medium text-gray-700 mb-2">
                            Saldo inicial
                        </label>

                        <input
                            type="number"
                            name="saldo"
                            id="saldo"
                            value="{{ old('saldo', '0.00') }}"
                            min="0"
                            step="0.01"
                            required
                            placeholder="200000.00"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('saldo')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="moneda" class="block text-sm font-medium text-gray-700 mb-2">
                            Moneda
                        </label>

                        <select
                            name="moneda"
                            id="moneda"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="COP" {{ old('moneda', 'COP') === 'COP' ? 'selected' : '' }}>
                                COP - Peso colombiano
                            </option>
                        </select>

                        @error('moneda')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
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
                            Guardar cuenta
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
