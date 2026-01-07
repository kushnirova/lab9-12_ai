@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Zarządzanie Adopcjami</h1>
    
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Użytkownik</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Świnka</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Opis</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adoptions as $adoption)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div>
                                    <p class="text-gray-900 whitespace-no-wrap font-medium">{{ $adoption->user->name }}</p>
                                    <p class="text-gray-600 whitespace-no-wrap text-xs">{{ $adoption->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $adoption->guineaPig->name }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-600 italic break-words w-48">{{ $adoption->notes }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight 
                                {{ $adoption->status === 'approved' ? 'text-green-900' : 
                                   ($adoption->status === 'rejected' ? 'text-red-900' : 'text-yellow-900') }}">
                                <span aria-hidden="true" class="absolute inset-0 opacity-50 rounded-full
                                    {{ $adoption->status === 'approved' ? 'bg-green-200' : 
                                       ($adoption->status === 'rejected' ? 'bg-red-200' : 'bg-yellow-200') }}">
                                </span>
                                <span class="relative">
                                    {{ $adoption->status === 'approved' ? 'Zatwierdzono' : 
                                       ($adoption->status === 'rejected' ? 'Odrzucono' : 'Oczekuje') }}
                                </span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if($adoption->status === 'pending')
                                <div class="flex space-x-2">
                                    <form action="{{ route('admin.adoptions.updateStatus', $adoption) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="text-green-600 hover:text-green-900 font-medium" aria-label="Zatwierdź adopcję świnki {{ $adoption->guineaPig->name }} przez {{ $adoption->user->name }}">Zatwierdź</button>
                                    </form>
                                    <form action="{{ route('admin.adoptions.updateStatus', $adoption) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium" aria-label="Odrzuć adopcję świnki {{ $adoption->guineaPig->name }} przez {{ $adoption->user->name }}">Odrzuć</button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-400 italic">Zakończone</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
