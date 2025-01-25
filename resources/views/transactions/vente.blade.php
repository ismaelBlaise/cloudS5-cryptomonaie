@extends('dashboard')

@section('content1')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Vente de Cryptomonnaie</h1>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('transactions.vente') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="crypto_id" class="block text-gray-700 font-medium mb-1">Cryptomonnaie</label>
            <select name="crypto_id" id="crypto_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Sélectionner une cryptomonnaie --</option>
                @foreach($cryptos as $crypto)
                    <option value="{{ $crypto->id }}">{{ $crypto->nom }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="quantite" class="block text-gray-700 font-medium mb-1">Quantité</label>
            <input type="number" name="quantite" id="quantite" step="0.01" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Vendre
        </button>
    </form>
</div>
@endsection
