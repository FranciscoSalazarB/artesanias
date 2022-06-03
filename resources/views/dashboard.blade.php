<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::user()->roll == "cliente")
            <x-cliente-tareas-bar/>
            @else
            <x-admin-tareas-bar/>
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(Auth::user()->roll == "cliente")
                    <x-cliente-dashboard/>
                    @else
                    <x-admin-dashboard/>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
