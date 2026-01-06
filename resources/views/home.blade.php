@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Witamy w Fundacji Świnek Morskich</h1>
        <p class="text-xl mb-8">Pomagamy świnkom znaleźć nowy dom i oferujemy opiekę hotelową.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-2">Adopcje</h2>
                <p class="mb-4">Znajdź swojego nowego przyjaciela.</p>
                <a href="{{ route('adoptions.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Zobacz świnki</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-2">Hotel</h2>
                <p class="mb-4">Zapewnij opiekę swojej śwince podczas wyjazdu.</p>
                <a href="{{ route('hotel.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Sprawdź ofertę</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-2">Sklep</h2>
                <p class="mb-4">Kup akcesoria i karmę, wspierając fundację.</p>
                <a href="{{ route('shop.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Idź do sklepu</a>
            </div>
        </div>
    </div>
@endsection
