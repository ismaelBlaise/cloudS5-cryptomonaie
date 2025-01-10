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
            'mot_de_passe' => 'required|min:8|confirmed',
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:1,2,3',
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
            'sexe' => ['id' => $request->sexe],  // Utiliser l'ID du sexe
        ];

        // Envoi des données à l'API Spring Boot
        $apiUrl = 'http://localhost:8080/utilisateur';
        $response = Http::post($apiUrl, $dto);

        if ($response->ok()) {
            // Rediriger vers la page de validation de compte
            return redirect()->route('validatercompte')->with('success', 'Inscription réussie ! Veuillez valider votre compte.');
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
            // Stocker l'e-mail dans la session
            $request->session()->put('email', $credentials['email']);
            return redirect()->route('validatepin');
        }

        return back()->withErrors([
            'email' => $response->body() ?? 'Erreur lors de la connexion.',
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
