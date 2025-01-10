@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-purple-500 via-pink-500 to-red-500">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">S'inscrire</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            </div>

            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="nom" name="nom" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            </div>

            <div class="mb-4">
                <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                <input type="date" id="date_naissance" name="date_naissance" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            </div>

            <div class="mb-4">
                <label for="mot_de_passe" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            </div>

            <div class="mb-4">
                <label for="sexe" class="block text-sm font-medium text-gray-700">Sexe</label>
                <select id="sexe" name="Id_sexe" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" required>
                    <option value="">Sélectionnez</option>
                    <option value="1">Homme</option>
                    <option value="2">Femme</option>
                    <option value="3">Autre</option>
                </select>
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-purple-600 text-white font-semibold rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600">S'inscrire</button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Déjà un compte ? <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Se connecter</a></p>
        </div>
    </div>
</div>
@endsection
