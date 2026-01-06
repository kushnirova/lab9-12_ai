@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-4xl mx-auto">
        <div class="md:flex">
            <div class="md:w-1/2">
                <img src="{{ $guineaPig->image_path }}" alt="Świnka {{ $guineaPig->name }}, rasa {{ $guineaPig->category->name }}" class="w-full h-full object-cover">
            </div>
            <div class="p-8 md:w-1/2">
                <h1 class="text-3xl font-bold mb-4">{{ $guineaPig->name }}</h1>
                <p class="text-gray-600 mb-2"><strong>Wiek:</strong> {{ $guineaPig->age }} lat</p>
                <p class="text-gray-600 mb-2"><strong>Rasa:</strong> {{ $guineaPig->category->name }}</p>
                <p class="text-gray-600 mb-6">{{ $guineaPig->description }}</p>
                
                @auth
                    <form action="{{ route('adoptions.store', $guineaPig) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="notes" class="block text-gray-700 font-bold mb-2">Dlaczego chcesz adoptować?</label>
                            <textarea name="notes" id="notes" rows="4" class="w-full border border-gray-300 p-2 rounded"></textarea>
                        </div>
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Wyślij wniosek adopcyjny</button>
                    </form>
                @else
                    <p class="text-red-600">Zaloguj się, aby wysłać wniosek adopcyjny.</p>
                    <a href="{{ route('login') }}" class="inline-block mt-2 text-blue-600 hover:underline">Przejdź do logowania</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
