@extends('dashboard')

@section('content1')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Échange de Cryptomonnaies</h1>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.echange') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="crypto_source_id" class="block text-gray-700 font-medium mb-1">Cryptomonnaie Source</label>
                <select name="crypto_source_id" id="crypto_source_id" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Sélectionner une cryptomonnaie --</option>
                    @foreach($cryptos as $crypto)
                        <option value="{{ $crypto->id }}">{{ $crypto->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="crypto_cible_id" class="block text-gray-700 font-medium mb-1">Cryptomonnaie Cible</label>
                <select name="crypto_cible_id" id="crypto_cible_id" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Sélectionner une cryptomonnaie --</option>
                    @foreach($cryptos as $crypto)
                        <option value="{{ $crypto->id }}">{{ $crypto->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="quantite" class="block text-gray-700 font-medium mb-1">Quantité à échanger</label>
            <input type="number" name="quantite" id="quantite" step="0.01" min="0.01" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Échanger
        </button>
    </form>
</div>
@endsection
