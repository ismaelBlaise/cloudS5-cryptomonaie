<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function depotForm()
    {
        return view('transactions.depot');
    }
    
    public function depot(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0.01',
        ]);
    
        // Logique pour créditer le portefeuille
        $montant = $request->input('montant');
        $compteId = auth()->user()->compte->id;
    
        // Exemple : Ajouter au portefeuille
        $portefeuille = auth()->user()->compte->portefeuille;
        $portefeuille->montant += $montant;
        $portefeuille->save();
    
        // Redirection avec succès
        return redirect()->route('transactions.depotForm')->with('success', 'Montant déposé avec succès.');
    }

    public function choixForm()
    {
        return view('transactions.choix');
    }

    public function venteForm()
    {
        $cryptos = \App\Models\Crypto::all(); // Liste des cryptos
        return view('transactions.vente', compact('cryptos'));
    }

    public function vente(Request $request)
    {
        $request->validate([
            'crypto_id' => 'required|exists:cryptos,id',
            'quantite' => 'required|numeric|min:0.01',
        ]);

        $crypto = \App\Models\Crypto::find($request->input('crypto_id'));
        $quantite = $request->input('quantite');

        // Récupérer le taux actuel
        $taux = $crypto->taux()->latest()->first();
        $montant = $quantite * $taux->prix;

        // Vérification et mise à jour
        $portefeuille = auth()->user()->compte->portefeuille;
        $portefeuille->montant += $montant;
        $portefeuille->save();

        // Redirection avec succès
        return redirect()->route('transactions.venteForm')->with('success', 'Vente effectuée avec succès.');
    }

    public function echangeForm()
    {
        $cryptos = \App\Models\Crypto::all(); // Liste des cryptos
        return view('transactions.echange', compact('cryptos'));
    }

    public function echange(Request $request)
    {
        $request->validate([
            'crypto_source_id' => 'required|exists:cryptos,id',
            'crypto_cible_id' => 'required|exists:cryptos,id|different:crypto_source_id',
            'quantite' => 'required|numeric|min:0.01',
        ]);

        $cryptoSource = \App\Models\Crypto::find($request->input('crypto_source_id'));
        $cryptoCible = \App\Models\Crypto::find($request->input('crypto_cible_id'));
        $quantite = $request->input('quantite');

        // Récupération des taux
        $tauxSource = $cryptoSource->taux()->latest()->first();
        $tauxCible = $cryptoCible->taux()->latest()->first();
        $montantCible = ($quantite * $tauxSource->prix) / $tauxCible->prix;

        // Mise à jour logique (ajout crypto cible, déduction crypto source)
        // ...

        return redirect()->route('transactions.echangeForm')->with('success', 'Échange effectué avec succès.');
    }

}
