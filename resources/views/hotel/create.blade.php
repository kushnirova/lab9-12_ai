@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Rezerwacja pobytu</h1>
        
        <form action="{{ route('hotel.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="guinea_pig_name" class="block text-gray-700 font-bold mb-2">Imię świnki</label>
                <input type="text" name="guinea_pig_name" id="guinea_pig_name" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="start_date" class="block text-gray-700 font-bold mb-2">Data od</label>
                    <input type="date" name="start_date" id="start_date" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label for="end_date" class="block text-gray-700 font-bold mb-2">Data do</label>
                    <input type="date" name="end_date" id="end_date" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="notes" class="block text-gray-700 font-bold mb-2">Uwagi (dieta, leki, itp.)</label>
                <textarea name="notes" id="notes" rows="4" class="w-full border border-gray-300 p-2 rounded"></textarea>
            </div>
            
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Zarezerwuj</button>
        </form>
    </div>
@endsection
