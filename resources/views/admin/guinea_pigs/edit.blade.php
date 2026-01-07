@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 max-w-2xl py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Edytuj świnkę: {{ $guineaPig->name }}</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.guinea_pigs.update', $guineaPig) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Imie</label>
                <input type="text" name="name" id="name" value="{{ old('name', $guineaPig->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Wiek (miesiące)</label>
                <input type="number" name="age" id="age" value="{{ old('age', $guineaPig->age) }}" required min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                @error('age') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategoria</label>
                <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2 bg-white">
                    <option value="">Wybierz kategorię</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $guineaPig->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2 bg-white">
                    <option value="available" {{ old('status', $guineaPig->status) == 'available' ? 'selected' : '' }}>Dostępna</option>
                    <option value="pending" {{ old('status', $guineaPig->status) == 'pending' ? 'selected' : '' }}>W trakcie adopcji</option>
                    <option value="adopted" {{ old('status', $guineaPig->status) == 'adopted' ? 'selected' : '' }}>Zaadoptowana</option>
                </select>
                @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Opis</label>
                <textarea name="description" id="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">{{ old('description', $guineaPig->description) }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image_path" class="block text-sm font-medium text-gray-700">Zmień zdjęcie</label>
                @if($guineaPig->image_path)
                    <div class="mb-2">
                        <p class="text-xs text-gray-500 mb-1">Obecne:</p>
                        <img src="{{ asset('storage/' . $guineaPig->image_path) }}" alt="Current image" class="h-20 w-auto rounded">
                    </div>
                @endif
                <input type="file" name="image_path" id="image_path" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF do 2MB</p>
                @error('image_path') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ route('admin.guinea_pigs.index') }}" class="mr-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Anuluj</a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Zaktualizuj</button>
            </div>
        </form>
    </div>
</div>
@endsection
