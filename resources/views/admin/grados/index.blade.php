<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('grados.create') }}" class="button primary">Crear Grado</a>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grados as $grado)
                                <tr>
                                    <td class="border px-4 py-2">{{ $grado->id }}</td>
                                    <td class="border px-4 py-2">{{ $grado->nombre }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('grados.edit', $grado) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('grados.destroy', $grado) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
