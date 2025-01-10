@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Validation du Code PIN</h2>
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                    <input type="hidden" id="email" name="email" value="{{ session('email') }}">
                    <label for="codepin" class="block text-gray-700">Code PIN :</label>
                    <input type="number" id="codepin" name="codepin" class="w-full border border-gray-300 p-2 rounded" required>
                    @error('codepin')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700">
                    Valider
                </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Se connecter ? <a href="{{ route('login') }}" class="text-gray-800 font-medium hover:underline">Se connecter</a></p>
        </div>
    </div>
</div>

<script>
        document.querySelector('#validation-pin-form').addEventListener('submit', async (event) => {
            event.preventDefault();

            const email = document.querySelector('#email').value;
            const codepin = document.querySelector('#codepin').value;

            try {
                const response = await fetch('http://localhost:8080/utilisateurs/valider-pin', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email, codepin }),
                });

                if (response.ok) {
                    const token = await response.text();
                    alert('Code PIN validé avec succès. Token : ' + token);
                    window.location.href = '/dashboard'; // Redirection vers le tableau de bord
                } else {
                    const errorMessage = await response.text();
                    document.getElementById('message').textContent = errorMessage;
                    document.getElementById('message').classList.remove('hidden');
                }
            } catch (error) {
                console.error('Erreur réseau :', error);
                document.getElementById('message').textContent = 'Une erreur est survenue. Veuillez réessayer.';
                document.getElementById('message').classList.remove('hidden');
            }
        });
    </script>
@endsection
