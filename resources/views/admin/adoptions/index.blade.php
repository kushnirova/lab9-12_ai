@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Zarządzanie Adopcjami</h1>
    
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Użytkownik</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Świnka</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akcje</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($adoptions as $adoption)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $adoption->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $adoption->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $adoption->guineaPig->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $adoption->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($adoption->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($adoption->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($adoption->status === 'pending')
                                <form action="{{ route('admin.adoptions.updateStatus', $adoption) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Zatwierdź</button>
                                </form>
                                <form action="{{ route('admin.adoptions.updateStatus', $adoption) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="text-red-600 hover:text-red-900">Odrzuć</button>
                                </form>
                            @else
                                <span class="text-gray-500">Zakończone</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
