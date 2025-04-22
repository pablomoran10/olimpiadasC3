<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Edicion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('partials.alerts')
                    <form action="{{ route('ediciones.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="curso_escolar" class="block text-gray-700">Curso Escolar</label>
                            <input type="text" name="curso_escolar" id="curso_escolar" value="{{ old('curso_escolar') }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="fecha_celebracion" class="block text-gray-700">Fecha Celebracion</label>
                            <input type="date" name="fecha_celebracion" id="fecha_celebracion" value="{{ old('fecha_celebracion') }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="fecha_apertura" class="block text-gray-700">Fecha Apertura</label>
                            <input type="date" name="fecha_apertura" id="fecha_apertura" value="{{ old('fecha_apertura') }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="fecha_cierre" class="block text-gray-700">Fecha Cierre</label>
                            <input type="date" name="fecha_cierre" id="fecha_cierre" value="{{ old('fecha_cierre') }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="css_file" class="block text-gray-700">File CSS</label>
                            <input type="file" name="css_file" id="css_file" class="w-full border-gray-300 rounded-md">
                        </div>
                        <input type="submit" class="primary" value="Guardar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
