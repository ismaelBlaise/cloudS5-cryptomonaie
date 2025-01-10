@extends('dashboard')

@section('content1')
<div class="min-h-screen flex flex-col items-center justify-center">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8 space-y-6">
            <!-- Titre principal -->
            <h1 class="text-3xl font-bold text-center text-blue-600">Choisissez une action</h1>
            <p class="text-center text-gray-600">Que souhaitez-vous faire aujourd'hui ?</p>

            <!-- Boutons de choix -->
            <div class="space-y-4">
                <a href="/transaction/vente" class="block w-full text-center bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 shadow">
                    Vente de Cryptomonnaies
                </a>
                <a href="/transaction/depot" class="block w-full text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 shadow">
                    Dépôt de Fonds
                </a>
                <a href="/transaction/echange" class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow">
                    Échange de Cryptomonnaies
                </a>
            </div>
        </div>
    </div>

    @endsection