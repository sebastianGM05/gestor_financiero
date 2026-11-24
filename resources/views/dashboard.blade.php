
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Panel financiero
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Administra tus cuentas, ingresos y gastos desde un solo lugar.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-gray-800">
                    ¡Bienvenido, {{ Auth::user()->name }}!
                </h3>
                <p class="text-gray-500 mt-1">
                    Este es el resumen general de tu gestión financiera.
                </p>
            </div>

            <!-- RESUMEN FINANCIERO -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">Saldo total</p>
                    <p class="text-3xl font-bold text-gray-800 mt-3">
                        ${{ number_format($saldoTotal, 2, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-400 mt-2">Saldo de todas las cuentas</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">Ingresos acumulados</p>
                    <p class="text-3xl font-bold text-green-600 mt-3">
                        ${{ number_format($totalIngresos, 2, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-400 mt-2">Total de ingresos registrados</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">Gastos acumulados</p>
                    <p class="text-3xl font-bold text-red-600 mt-3">
                        ${{ number_format($totalGastos, 2, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-400 mt-2">Total de gastos registrados</p>
                </div>

            </div>

            <!-- CONTADORES -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm text-gray-500">Cuentas registradas</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ $cantidadCuentas }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm text-gray-500">Categorías registradas</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ $cantidadCategorias }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm text-gray-500">Transacciones registradas</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">
                        {{ $cantidadTransacciones }}
                    </p>
                </div>

            </div>

            <!-- RESUMEN MENSUAL -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-5">
                    Resumen del mes actual
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="bg-green-50 rounded-lg p-5">
                        <p class="text-sm text-green-700">Ingresos del mes</p>
                        <p class="text-2xl font-bold text-green-700 mt-2">
                            ${{ number_format($ingresosMes, 2, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-red-50 rounded-lg p-5">
                        <p class="text-sm text-red-700">Gastos del mes</p>
                        <p class="text-2xl font-bold text-red-700 mt-2">
                            ${{ number_format($gastosMes, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- ACCESOS DIRECTOS -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-5">
                    Accesos rápidos
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    <a href="{{ route('categorias.index') }}"
                       style="display:block; border:1px solid #e5e7eb; border-radius:10px; padding:20px; text-decoration:none;">
                        <h4 class="font-semibold text-gray-800">
                            Administrar categorías
                        </h4>
                        <p class="text-sm text-gray-500 mt-2">
                            Consultar, editar y eliminar categorías.
                        </p>
                    </a>

                    <a href="{{ route('categorias.create') }}"
                       style="display:block; border:1px solid #c7d2fe; border-radius:10px; padding:20px; text-decoration:none; background-color:#eef2ff;">
                        <h4 class="font-semibold" style="color:#4338ca;">
                            + Nueva categoría
                        </h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Registrar una categoría de ingreso o gasto.
                        </p>
                    </a>

                    <a href="{{ route('cuentas.index') }}"
                       style="display:block; border:1px solid #e5e7eb; border-radius:10px; padding:20px; text-decoration:none;">
                        <h4 class="font-semibold text-gray-800">
                            Administrar cuentas
                        </h4>
                        <p class="text-sm text-gray-500 mt-2">
                            Consultar saldos y administrar cuentas.
                        </p>
                    </a>

                    <a href="{{ route('cuentas.create') }}"
                       style="display:block; border:1px solid #c7d2fe; border-radius:10px; padding:20px; text-decoration:none; background-color:#eef2ff;">
                        <h4 class="font-semibold" style="color:#4338ca;">
                            + Nueva cuenta
                        </h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Registrar una nueva cuenta financiera.
                        </p>
                    </a>

                    <a href="{{ route('transacciones.index') }}"
                       style="display:block; border:1px solid #e5e7eb; border-radius:10px; padding:20px; text-decoration:none;">
                        <h4 class="font-semibold text-gray-800">
                            Administrar transacciones
                        </h4>
                        <p class="text-sm text-gray-500 mt-2">
                            Consultar, editar y eliminar movimientos.
                        </p>
                    </a>

                    <a href="{{ route('transacciones.create') }}"
                       style="display:block; border:1px solid #c7d2fe; border-radius:10px; padding:20px; text-decoration:none; background-color:#eef2ff;">
                        <h4 class="font-semibold" style="color:#4338ca;">
                            + Nueva transacción
                        </h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Registrar directamente un ingreso o gasto.
                        </p>
                    </a>

                </div>
            </div>

            <!-- ÚLTIMAS TRANSACCIONES -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-5">
                    Últimas transacciones
                </h3>

                @if($ultimasTransacciones->isEmpty())
                    <p class="text-gray-500 text-sm">
                        Todavía no hay transacciones registradas.
                    </p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cuenta</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Monto</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($ultimasTransacciones as $transaccion)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            {{ $transaccion->fecha->format('d/m/Y') }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-800">
                                            {{ $transaccion->descripcion ?: 'Sin descripción' }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            {{ $transaccion->categoria->nombre }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            {{ $transaccion->cuenta->nombre }}
                                        </td>

                                        <td class="px-4 py-3 text-sm font-semibold text-right
                                            {{ $transaccion->tipo === 'ingreso' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $transaccion->tipo === 'ingreso' ? '+' : '-' }}${{ number_format($transaccion->monto, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

