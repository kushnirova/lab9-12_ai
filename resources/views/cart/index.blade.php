@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 max-w-4xl">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Twój Koszyk</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Produkt</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Cena</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Ilość</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Razem</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Akcje</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $details['name'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">{{ number_format($details['price'], 2) }} zł</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-1 text-sm text-center">
                                    <button type="submit" class="ml-2 text-blue-600 hover:text-blue-900 text-sm font-medium">Aktualizuj</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ number_format($details['price'] * $details['quantity'], 2) }} zł</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-right text-sm font-bold text-gray-900">Suma całkowita:</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ number_format($total, 2) }} zł</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="flex justify-end">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded shadow hover:bg-green-700 font-bold text-lg">Do opłaty</button>
            </form>
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-600 text-lg mb-4">Koszyk na razie jest pusty.</p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Wróć do sklepu</a>
        </div>
    @endif
</div>
@endsection
