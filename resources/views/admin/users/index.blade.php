@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Zarządzanie Użytkownikami</h1>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nazwa</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rola</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dołączył</th>
                    <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap font-medium">{{ $user->name }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight
                            {{ $user->role === 'admin' ? 'text-red-900' : '' }}
                            {{ $user->role === 'employee' ? 'text-blue-900' : '' }}
                            {{ $user->role === 'client' ? 'text-green-900' : '' }}">
                            <span aria-hidden="true" class="absolute inset-0 opacity-50 rounded-full
                                {{ $user->role === 'admin' ? 'bg-red-200' : '' }}
                                {{ $user->role === 'employee' ? 'bg-blue-200' : '' }}
                                {{ $user->role === 'client' ? 'bg-green-200' : '' }}">
                            </span>
                            <span class="relative">
                                @if($user->role === 'admin') Administrator
                                @elseif($user->role === 'employee') Pracownik
                                @else Klient
                                @endif
                            </span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $user->created_at->format('d.m.Y') }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900" aria-label="Edytuj użytkownika {{ $user->name }}">Edytuj</a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" aria-label="Usuń użytkownika {{ $user->name }}">Usuń</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
