@extends('layouts.app')

@section('content')

    <!-- Structure principale -->
    <div class="flex h-screen">
        
        <!-- Barre latérale -->
        <aside class="w-64 bg-purple-600 text-white flex flex-col">
            
            <nav class="flex-1">
                <ul>
                    <li class="p-4 hover:bg-purple-700">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                            <span class="material-icons">dashboard</span>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li class="p-4 hover:bg-purple-700">
                        <a href="" class="flex items-center space-x-2">
                            <span class="material-icons">account_balance_wallet</span>
                            <span>Portefeuille</span>
                        </a>
                    </li>
                    <li class="p-4 hover:bg-purple-700">
                        <a href="" class="flex items-center space-x-2">
                            <span class="material-icons">money</span>
                            <span>Gestion des fonds (Dépôt/Retrait)</span>
                        </a>
                    </li>
                    <li class="p-4 hover:bg-purple-700">
                        <a href="" class="flex items-center space-x-2">
                            <span class="material-icons">trending_up</span>
                            <span>Cours en temps réel</span>
                        </a>
                    </li>
                    <li class="p-4 hover:bg-purple-700">
                        <a href="" class="flex items-center space-x-2">
                            <span class="material-icons">show_chart</span>
                            <span>Évolution graphique</span>
                        </a>
                    </li>
                    <li class="p-4 hover:bg-purple-700">
                        <a href="" class="flex items-center space-x-2">
                            <span class="material-icons">swap_horiz</span>
                            <span>Achat et vente de cryptomonnaie</span>
                        </a>
                    </li>
                    <li class="p-4 hover:bg-purple-700">
                        <a href="" class="flex items-center space-x-2">
                            <span class="material-icons">history</span>
                            <span>Historique des achats/ventes</span>
                        </a>
                    </li>
                    <li class="p-4 hover:bg-purple-700">
                        <a href="#" class="flex items-center space-x-2">
                            <span class="material-icons">support</span>
                            <span>Support</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-4 border-t border-purple-700">
                <a href="{{ route('logout') }}" class="flex items-center space-x-2 text-gray-200 hover:text-white">
                    <span class="material-icons">logout</span>
                    <span>Se déconnecter</span>
                </a>
            </div>
        </aside>

        <!-- Contenu principal -->
        <main class="flex-1 bg-gray-100 p-6">
            <header class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
                <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                    Nouvelle action
                </a>
            </header>
            
            <!-- Contenu dynamique -->
            <div>
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Icons Material -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@endsection
