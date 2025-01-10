@extends('dashboard')

@section('content1')
<div class="container">
    <h1>Dépôt de fonds</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('transactions.depot') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="montant" class="form-label">Montant</label>
            <input type="number" name="montant" class="form-control" id="montant" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Déposer</button>
    </form>
</div>
@endsection
