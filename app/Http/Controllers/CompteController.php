<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

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

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:comptes,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Création du compte
        $compte = new Compte;
        $compte->email = $request->email;
        $compte->password = Hash::make($request->password);  // Hachage du mot de passe
        $compte->save();

        // Enregistrement réussi, redirection vers la page de connexion
        event(new Registered($compte));

        return redirect()->route('login')->with('success', 'Inscription réussie ! Veuillez vous connecter.');
    }

    /**
     * Authentifie l'utilisateur.
     */
    public function authenticate(Request $request)
    {
        // Validation des données
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis sont incorrects.',
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
