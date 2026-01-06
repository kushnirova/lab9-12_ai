<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundacja Świnek Morskich</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 bg-blue-600 text-white p-2 z-50">Przejdź do treści</a>

    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">Fundacja Świnek</a>
            <ul class="flex space-x-4">
                <li><a href="{{ route('adoptions.index') }}" class="hover:text-blue-600">Adopcje</a></li>
                <li><a href="{{ route('hotel.index') }}" class="hover:text-blue-600">Hotel</a></li>
                <li><a href="{{ route('shop.index') }}" class="hover:text-blue-600">Sklep</a></li>
                @auth
                    <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Panel</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-blue-600">Wyloguj</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-blue-600">Logowanie</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main id="main-content" class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-8 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Fundacja Świnek Morskich. Wszelkie prawa zastrzeżone.</p>
        </div>
    </footer>
</body>
</html>
