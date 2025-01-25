@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Validation de votre compte</h2>

        <p class="text-center text-sm text-gray-600 mb-4">Votre inscription a été réussie. Un e-mail de validation a été envoyé à l'adresse fournie.</p>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Vous pouvez vous connecter une fois votre compte validé. <a href="{{ route('login') }}" class="text-gray-800 font-medium hover:underline">Se connecter</a></p>
        </div>
    </div>
</div>
@endsection
