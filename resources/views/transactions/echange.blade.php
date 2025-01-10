@extends('dashboard')

@section('content1')
<div class="container">
    <h1>Échange de Cryptomonnaies</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.echange') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="crypto_source_id" class="form-label">Cryptomonnaie Source</label>
                <select name="crypto_source_id" id="crypto_source_id" class="form-select" required>
                    <option value="">-- Sélectionner une cryptomonnaie --</option>
                    @foreach($cryptos as $crypto)
                        <option value="{{ $crypto->id }}">{{ $crypto->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="crypto_cible_id" class="form-label">Cryptomonnaie Cible</label>
                <select name="crypto_cible_id" id="crypto_cible_id" class="form-select" required>
                    <option value="">-- Sélectionner une cryptomonnaie --</option>
                    @foreach($cryptos as $crypto)
                        <option value="{{ $crypto->id }}">{{ $crypto->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité à échanger</label>
            <input type="number" name="quantite" id="quantite" class="form-control" step="0.01" min="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Échanger</button>
    </form>
</div>
@endsection
