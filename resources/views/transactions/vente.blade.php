@extends('dashboard')

@section('content1')
<div class="container">
    <h1>Vente de Cryptomonnaie</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('transactions.vente') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="crypto_id" class="form-label">Cryptomonnaie</label>
            <select name="crypto_id" id="crypto_id" class="form-select" required>
                @foreach($cryptos as $crypto)
                    <option value="{{ $crypto->id }}">{{ $crypto->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" class="form-control" id="quantite" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Vendre</button>
    </form>
</div>
@endsection
