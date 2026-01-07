@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Logowanie</h1>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 p-2 rounded" required>
                @error('email')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Hasło</label>
                <input type="password" name="password" id="password" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Zaloguj się</button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800" href="{{ route('register') }}">
                    Zarejestruj się
                </a>
            </div>
        </form>
        
        <div class="mt-4 text-sm text-gray-600">
            <p>Dane testowe:</p>
            <ul class="list-disc list-inside">
                <li>Admin: admin@example.com / password</li>
                <li>Pracownik: employee@example.com / password</li>
                <li>Klient: client@example.com / password</li>
            </ul>
        </div>
    </div>
@endsection
