@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">S'inscrire</h2>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-400" required>
            </div>

            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-600">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-400" required>
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-600">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-400" required>
            </div>

            <div class="mb-4">
                <label for="date_naissance" class="block text-sm font-medium text-gray-600">Date de naissance</label>
                <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-400" required>
            </div>

            <div class="mb-4">
                <label for="mot_de_passe" class="block text-sm font-medium text-gray-600">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-400" required>
            </div>

            <div class="mb-4">
                <label for="sexe" class="block text-sm font-medium text-gray-600">Sexe</label>
                <select id="sexe" name="Id_sexe" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-400" required>
                    <option value="">Sélectionnez</option>
                    <option value="1" >Homme</option>
                    <option value="2">Femme</option>
                    <option value="3" >Autre</option>
                </select>
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-gray-800 text-white font-medium rounded-md hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-400">S'inscrire</button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Déjà un compte ? <a href="{{ route('login') }}" class="text-gray-800 font-medium hover:underline">Se connecter</a></p>
        </div>
    </div>
</div>
@endsection
