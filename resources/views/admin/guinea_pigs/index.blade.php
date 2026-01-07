@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Zarządzanie Świnkami</h1>
        <a href="{{ route('admin.guinea_pigs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" aria-label="Dodaj nową świnkę">Dodaj Świnkę</a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Imie</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Wiek</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategoria</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guineaPigs as $pig)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            @if($pig->image_path)
                                <div class="flex-shrink-0 w-10 h-10">
                                    <img class="w-full h-full rounded-full object-cover" src="{{ asset($pig->image_path) }}" alt="Zdjęcie świnki {{ $pig->name }}" />
                                </div>
                            @endif
                            <div class="{{ $pig->image_path ? 'ml-3' : '' }}">
                                <p class="text-gray-900 whitespace-no-wrap font-medium">{{ $pig->name }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $pig->age }} mies.</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $pig->category->name ?? 'Brak' }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight
                            {{ $pig->status === 'available' ? 'text-green-900' : '' }}
                            {{ $pig->status === 'adopted' ? 'text-gray-900' : '' }}
                            {{ $pig->status === 'pending' ? 'text-yellow-900' : '' }}">
                            <span aria-hidden="true" class="absolute inset-0 opacity-50 rounded-full
                                {{ $pig->status === 'available' ? 'bg-green-200' : '' }}
                                {{ $pig->status === 'adopted' ? 'bg-gray-200' : '' }}
                                {{ $pig->status === 'pending' ? 'bg-yellow-200' : '' }}">
                            </span>
                            <span class="relative">
                                @if($pig->status === 'available') Dostępna
                                @elseif($pig->status === 'adopted') Zaadoptowana
                                @elseif($pig->status === 'pending') W trakcie
                                @endif
                            </span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.guinea_pigs.edit', $pig) }}" class="text-blue-600 hover:text-blue-900" aria-label="Edytuj świnkę {{ $pig->name }}">Edytuj</a>
                            <form action="{{ route('admin.guinea_pigs.destroy', $pig) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę świnkę?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" aria-label="Usuń świnkę {{ $pig->name }}">Usuń</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
            {{ $guineaPigs->links() }}
        </div>
    </div>
</div>
@endsection
