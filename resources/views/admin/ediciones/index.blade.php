<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ediciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('ediciones.create') }}" class="button primary">Crear Edicion</a>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Curso Escolar</th>
                                <th class="px-4 py-2">Fecha Celebracion</th>
                                <th class="px-4 py-2">Fecha Apertura</th>
                                <th class="px-4 py-2">Fecha Cierre</th>
                                <th class="px-4 py-2">File CSS</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ediciones as $edicion)
                                <tr>
                                    <td class="border px-4 py-2">{{ $edicion->id }}</td>
                                    <td class="border px-4 py-2">{{ $edicion->curso_escolar }}</td>
                                    <td class="border px-4 py-2">{{ $edicion->fecha_celebracion }}</td>
                                    <td class="border px-4 py-2">{{ $edicion->fecha_apertura }}</td>
                                    <td class="border px-4 py-2">{{ $edicion->fecha_cierre }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ asset('storage/' . $edicion->css_file) }}" target="_blank" class="text-blue-500 underline">Ver archivo CSS</a>
                                    </td>

                                    <td class="border px-4 py-2">
                                        <a href="{{ route('ediciones.edit', $edicion) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('ediciones.destroy', $edicion) }}" method="POST" class="inline">
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
