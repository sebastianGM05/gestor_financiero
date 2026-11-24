
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Editar transacción
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Modifica los datos de la transacción seleccionada.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <form action="{{ route('transacciones.update', $transaccion) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo de transacción
                        </label>

                        <select
                            name="tipo"
                            id="tipo"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="ingreso" {{ old('tipo', $transaccion->tipo) === 'ingreso' ? 'selected' : '' }}>
                                Ingreso
                            </option>

                            <option value="gasto" {{ old('tipo', $transaccion->tipo) === 'gasto' ? 'selected' : '' }}>
                                Gasto
                            </option>
                        </select>

                        @error('tipo')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="cuenta_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Cuenta
                        </label>

                        <select
                            name="cuenta_id"
                            id="cuenta_id"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            @foreach($cuentas as $cuenta)
                                <option
                                    value="{{ $cuenta->id }}"
                                    {{ old('cuenta_id', $transaccion->cuenta_id) == $cuenta->id ? 'selected' : '' }}
                                >
                                    {{ $cuenta->nombre }} - ${{ number_format((float) $cuenta->saldo, 2, ',', '.') }}
                                </option>
                            @endforeach
                        </select>

                        @error('cuenta_id')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Categoría
                        </label>

                        <select
                            name="categoria_id"
                            id="categoria_id"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            @foreach($categorias as $categoria)
                                <option
                                    value="{{ $categoria->id }}"
                                    {{ old('categoria_id', $transaccion->categoria_id) == $categoria->id ? 'selected' : '' }}
                                >
                                    {{ $categoria->nombre }} ({{ ucfirst($categoria->tipo) }})
                                </option>
                            @endforeach
                        </select>

                        @error('categoria_id')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="monto" class="block text-sm font-medium text-gray-700 mb-2">
                            Monto
                        </label>

                        <input
                            type="number"
                            name="monto"
                            id="monto"
                            value="{{ old('monto', $transaccion->monto) }}"
                            min="0.01"
                            step="0.01"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('monto')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha
                        </label>

                        <input
                            type="date"
                            name="fecha"
                            id="fecha"
                            value="{{ old('fecha', $transaccion->fecha->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('fecha')
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
                            rows="3"
                            maxlength="255"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('descripcion', $transaccion->descripcion) }}</textarea>

                        @error('descripcion')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3">

                        <a
                            href="{{ route('transacciones.index') }}"
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
                            Actualizar transacción
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
