<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Http;


class CompteController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function index()
    {
        return view("auth.login");
    }

    /**
     * Affiche le formulaire d'inscription.
     */
    public function create()
    {
        return view('auth.register');
    }

    public function validatePin()
    {
        return view('auth.validerpin');
    }

    public function validateCompte()
    {
        return view('auth.validercompte');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:compte,email',
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                            ->withErrors($validator)
                            ->withInput();
        }

        // Création du DTO UtilisateurDTO
        $dto = [
            'email' => $request->email,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'mot_de_passe' => Hash::make($request->mot_de_passe),
            // 'sexe' => ['id' => $request->sexe],  // Utiliser l'ID du sexe
        ];

        // Envoi des données à l'API Spring Boot
        $apiUrl = 'http://localhost:8080/utilisateurs/inscrire';
        $response = Http::post($apiUrl, $dto);

        if ($response->ok()) {
            // Rediriger vers la page de validation de compte
            return redirect()->route('validatepin')->with('success', 'Inscription réussie ! Veuillez valider votre compte.');
        }

        // Si l'API retourne une erreur, retourner le message d'erreur
        return redirect()->route('register')->withErrors([
            'error' => $response->body() ?? 'Erreur lors de l\'inscription.',
        ]);
    }

    /**
     * Authentifie l'utilisateur.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Requête vers l'API Spring Boot
        $apiUrl = 'http://localhost:8080/utilisateurs/connexion';
        $response = Http::post($apiUrl, [
            'email' => $credentials['email'],
            'motDePasse' => $credentials['password'],
        ]);

        if ($response->ok()) {
            // Stocker l'e-mail et le code PIN dans la session
            $pin = $response->json()['pin'];  // Supposons que la réponse contient le PIN
            $request->session()->put('email', $credentials['email']);
            $request->session()->put('pin', $pin);  // Stocker le PIN dans la session

            return redirect()->route('validatepin');
        }

        return back()->withErrors([
            'email' => $response->body() ?? 'Erreur lors de la connexion.',
        ]);
    }


    public function validerPin(Request $request)
    {
        // Vérifier si le code PIN est dans la session
        $pinStored = $request->session()->get('pin');

        // Valider le code PIN entré par l'utilisateur
        $request->validate([
            'pin' => 'required|digits:4',  // Supposons que le PIN soit un nombre à 4 chiffres
        ]);

        // Vérifier si le PIN correspond
        if ($request->input('pin') == $pinStored) {
            // Si le PIN est correct, rediriger vers le tableau de bord
            return redirect()->route('dashboard');
        }

        // Si le PIN est incorrect, afficher un message d'erreur
        return back()->withErrors([
            'pin' => 'Le code PIN est incorrect.',
        ]);
    }


    /**
     * Affiche le tableau de bord après connexion.
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}                    
