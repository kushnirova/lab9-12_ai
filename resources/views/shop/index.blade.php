@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Sklepik Fundacji</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-bold mb-2">{{ $product->name }}</h2>
                <p class="text-gray-600 mb-2 text-sm">{{ $product->description }}</p>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-xl font-bold text-purple-600">{{ $product->price }} PLN</span>
                    <button class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">Dodaj do koszyka</button>
                </div>
            </div>
        @endforeach
    </div>
@endsection
