<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme Cryptomonnaie</title>
    
    <!-- Ajouter Tailwind CSS via CDN ou via Laravel Mix -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optionnel : Ajouter vos styles CSS personnalisés -->
    <style>
        /* Personnalisation des styles ici si nécessaire */
    </style>
</head>
<body class="font-sans bg-gray-100">

    <!-- Barre de navigation -->
    <nav class="bg-purple-600 shadow-md p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-white text-2xl font-bold">CryptoPlateforme</a>
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-200 px-4">Tableau de bord</a>
                    <a href="{{ route('logout') }}" class="text-white hover:text-gray-200 px-4">Se déconnecter</a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-200 px-4">Se connecter</a>
                    <a href="{{ route('register') }}" class="text-white hover:text-gray-200 px-4">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="min-h-screen">
        @yield('content')
    </div>

    
</body>
</html>
