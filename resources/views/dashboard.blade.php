@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Panel Użytkownika</h1>
    
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4">Twoje Adopcje</h2>
        @if($adoptions->isEmpty())
            <p class="text-gray-600">Brak wniosków adopcyjnych.</p>
        @else
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    @foreach($adoptions as $adoption)
                        <li class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-blue-600 truncate">
                                    Świnka: {{ $adoption->guineaPig->name }}
                                </p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $adoption->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($adoption->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($adoption->status) }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    
    <div>
        <h2 class="text-2xl font-bold mb-4">Twoje Rezerwacje Hotelowe</h2>
        @if($bookings->isEmpty())
            <p class="text-gray-600">Brak rezerwacji.</p>
        @else
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                        <li class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-600 truncate">
                                        {{ $booking->guinea_pig_name }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        {{ $booking->start_date }} - {{ $booking->end_date }}
                                    </p>
                                </div>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                           ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'employee')
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Panel Administracyjny</h2>
            <a href="{{ route('admin.adoptions.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Zarządzaj Adopcjami</a>
        </div>
    @endif
@endsection
