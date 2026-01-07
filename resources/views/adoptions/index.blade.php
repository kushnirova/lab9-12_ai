@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Świnki do adopcji</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($guineaPigs as $pig)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset($pig->image_path) }}" alt="Świnka {{ $pig->name }}, rasa {{ $pig->category->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $pig->name }}</h2>
                    <p class="text-gray-600 mb-2">Wiek: {{ $pig->age }} lat</p>
                    <p class="text-gray-600 mb-4">Rasa: {{ $pig->category->name }}</p>
                    <a href="{{ route('adoptions.show', $pig) }}" class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Zobacz szczegóły</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
