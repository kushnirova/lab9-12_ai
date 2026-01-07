@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Zarządzanie Rezerwacjami Hotelowymi</h1>
    
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Klient</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Świnka</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Termin</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Uwagi</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div>
                                    <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $booking->user->name }}</p>
                                    <p class="text-gray-600 whitespace-no-wrap text-xs">{{ $booking->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $booking->guinea_pig_name }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $booking->start_date }} <br> do <br> {{ $booking->end_date }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-48">
                            <p class="text-gray-600 italic break-words">{{ $booking->notes }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight
                                {{ $booking->status === 'confirmed' ? 'text-green-900' : 
                                   ($booking->status === 'cancelled' ? 'text-red-900' : 'text-yellow-900') }}">
                                <span aria-hidden="true" class="absolute inset-0 opacity-50 rounded-full
                                    {{ $booking->status === 'confirmed' ? 'bg-green-200' : 
                                       ($booking->status === 'cancelled' ? 'bg-red-200' : 'bg-yellow-200') }}">
                                </span>
                                <span class="relative">
                                    {{ $booking->status === 'confirmed' ? 'Potwierdzona' : 
                                       ($booking->status === 'cancelled' ? 'Anulowana' : 'Oczekująca') }}
                                </span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex flex-col gap-2">
                                @if($booking->status !== 'confirmed')
                                <form action="{{ route('admin.hotel_bookings.updateStatus', $booking) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-bold">Potwierdź</button>
                                </form>
                                @endif
                                @if($booking->status !== 'cancelled')
                                <form action="{{ route('admin.hotel_bookings.updateStatus', $booking) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Anuluj</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($bookings->isEmpty())
            <div class="p-4 text-center text-gray-500">Brak rezerwacji w systemie.</div>
        @endif
    </div>
</div>
@endsection
