
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Gestión de transacciones
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Consulta y administra tus ingresos y gastos.
            </p>
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

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Transacciones registradas
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Total de transacciones: {{ $transacciones->total() }}
                        </p>
                    </div>

                    <a
                        href="{{ route('transacciones.create') }}"
                        style="background-color: #4f46e5; color: #ffffff; border: 1px solid #4338ca;"
                        class="inline-block text-center px-5 py-2 rounded-lg font-semibold shadow-sm hover:opacity-90"
                    >
                        Nueva transacción
                    </a>
                </div>

                @if($transacciones->isEmpty())
                    <div class="text-center py-12">
                        <h4 class="text-gray-700 font-semibold mb-2">
                            Todavía no hay transacciones registradas.
                        </h4>
                        <p class="text-gray-500 text-sm">
                            Registra tu primer ingreso o gasto para comenzar.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="px-4 py-3">Fecha</th>
                                    <th class="px-4 py-3">Tipo</th>
                                    <th class="px-4 py-3">Categoría</th>
                                    <th class="px-4 py-3">Cuenta</th>
                                    <th class="px-4 py-3">Monto</th>
                                    <th class="px-4 py-3">Descripción</th>
                                    <th class="px-4 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach($transacciones as $transaccion)
                                    <tr>
                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $transaccion->fecha->format('d/m/Y') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            @if($transaccion->tipo === 'ingreso')
                                                <span class="font-semibold text-green-700">
                                                    Ingreso
                                                </span>
                                            @else
                                                <span class="font-semibold text-red-700">
                                                    Gasto
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3 text-gray-700">
                                            {{ $transaccion->categoria->nombre }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-700">
                                            {{ $transaccion->cuenta->nombre }}
                                        </td>

                                        <td class="px-4 py-3 font-semibold text-gray-800">
                                            ${{ number_format((float) $transaccion->monto, 2, ',', '.') }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $transaccion->descripcion ?: 'Sin descripción' }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-center gap-3">
                                                <a
                                                    href="{{ route('transacciones.edit', $transaccion) }}"
                                                    style="color: #4f46e5;"
                                                    class="font-semibold hover:underline"
                                                >
                                                    Editar
                                                </a>

                                                <form
                                                    action="{{ route('transacciones.destroy', $transaccion) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar esta transacción? Se actualizará el saldo de la cuenta.');"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        style="background-color: #dc2626; color: #ffffff; border: 1px solid #b91c1c;"
                                                        class="px-3 py-1 rounded-md font-semibold hover:opacity-90"
                                                    >
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

                    <div class="mt-6">
                        {{ $transacciones->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
