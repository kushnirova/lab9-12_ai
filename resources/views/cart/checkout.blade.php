@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16 text-center">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-8 rounded relative mb-4 max-w-2xl mx-auto" role="alert">
        <h2 class="text-2xl font-bold mb-2">Sukces!</h2>
        <p class="text-xl">Tu powinna być strona opłaty. Dziekujemy za zamówienie!</p>
    </div>
    <a href="{{ route('shop.index') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded shadow hover:bg-blue-700 font-bold">Wróć do sklepu</a>
</div>
@endsection
