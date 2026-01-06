@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Hotel dla świnek morskich</h1>
    
    <div class="mb-8">
        <p class="text-lg mb-4">Zapewniamy profesjonalną opiekę dla Twoich pupili podczas Twojej nieobecności.</p>
        @auth
            <a href="{{ route('hotel.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Zarezerwuj pobyt</a>
        @else
            <p class="text-red-600">Zaloguj się, aby zarezerwować pobyt.</p>
        @endauth
    </div>
    
    <h2 class="text-2xl font-bold mb-4">Cennik usług dodatkowych</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($services as $service)
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-2">{{ $service->name }}</h3>
                <p class="text-gray-600 mb-2">{{ $service->description }}</p>
                <p class="text-2xl font-bold text-green-600">{{ $service->price }} PLN</p>
            </div>
        @endforeach
    </div>
@endsection
