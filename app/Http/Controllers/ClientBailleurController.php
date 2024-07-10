<?php

namespace App\Http\Controllers;

use App\Models\DateIndisponible;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\BienImmobilier;
use App\Models\ClientBailleur;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientBailleurController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $bailleur = $user->clientBailleur;

        $biens = $bailleur->biensImmobiliers;

        return view('client_bailleur.index', compact('biens'));

    }

    public function create()
    {
        return view('client_bailleur.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|in:Paris,Marseille,Lille,Lyon,Bordeaux',
            'prix' => 'required|numeric|min:1',
            'nombre_de_chambres' => 'required|integer|min:0',
            'nombre_de_salles_de_bain' => 'required|integer|min:0',
            'superficie' => 'required|integer|min:0',
            'type_de_bien' => 'required|string|in:Appartement,Maison,Gîte',
            'nombre_de_lits' => 'required|integer|min:0',
            'capacite_max' => 'required|integer|min:1',
            'wifi' => 'required|boolean',
            'parking' => 'required|boolean',
            'climatisation' => 'required|boolean',
            'chauffage' => 'required|boolean',
            'cuisine' => 'required|boolean',
            'animaux_acceptes' => 'required|boolean'
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'numeric' => 'Le champ :attribute doit être un nombre.',
            'integer' => 'Le champ :attribute doit être un entier.',
            'min' => 'Le champ :attribute doit être au moins de :min.',
            'boolean' => 'Le champ :attribute doit être vrai ou faux.',
            'in' => 'Le champ :attribute doit être l\'un des suivants : :values.',
        ], [
            'nombre_de_chambres' => 'nombre de chambres',
            'nombre_de_salles_de_bain' => 'nombre de salles de bain',
            'type_de_bien' => 'type de bien',
            'nombre_de_lits' => 'nombre de lits',
            'capacite_max' => 'capacité max',
            'wifi' => 'WiFi',
            'animaux_acceptes' => 'animaux acceptés',
        ]);

        try {
            $user = auth()->user();
            $clientBailleur = $user->clientBailleur;

            $bienImmobilier = BienImmobilier::create([
                'titre' => $validated['titre'],
                'description' => $validated['description'],
                'adresse' => $validated['adresse'],
                'ville' => $validated['ville'],
                'prix' => $validated['prix'],
                'nombre_de_chambres' => $validated['nombre_de_chambres'],
                'nombre_de_salles_de_bain' => $validated['nombre_de_salles_de_bain'],
                'superficie' => $validated['superficie'],
                'type_de_bien' => $validated['type_de_bien'],
                'nombre_de_lits' => $validated['nombre_de_lits'],
                'capacite_max' => $validated['capacite_max'],
                'wifi' => $validated['wifi'],
                'parking' => $validated['parking'],
                'climatisation' => $validated['climatisation'],
                'chauffage' => $validated['chauffage'],
                'cuisine' => $validated['cuisine'],
                'animaux_acceptes' => $validated['animaux_acceptes'],
                'statut' => 'En Attente',
                'client_bailleur_id' => $clientBailleur->id
            ]);

            return redirect()->route('client_bailleur.index')
                ->with('success', 'Le bien immobilier "' . $bienImmobilier->titre . '" a été ajouté  avec succès.');
        }catch (\Exception $e) {
            Log::error('Erreur lors de l\'ajout du bien immobilier: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'ajout du bien immobilier "' . $bienImmobilier->titre . '".');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|in:Paris,Marseille,Lille,Lyon,Bordeaux',
            'prix' => 'required|numeric|min:1',
            'nombre_de_chambres' => 'required|integer|min:0',
            'nombre_de_salles_de_bain' => 'required|integer|min:0',
            'superficie' => 'required|integer|min:0',
            'type_de_bien' => 'required|string|in:Appartement,Maison,Gîte',
            'nombre_de_lits' => 'required|integer|min:0',
            'capacite_max' => 'required|integer|min:1',
            'wifi' => 'required|boolean',
            'parking' => 'required|boolean',
            'climatisation' => 'required|boolean',
            'chauffage' => 'required|boolean',
            'cuisine' => 'required|boolean',
            'animaux_acceptes' => 'required|boolean'
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'numeric' => 'Le champ :attribute doit être un nombre.',
            'integer' => 'Le champ :attribute doit être un entier.',
            'min' => 'Le champ :attribute doit être au moins de :min.',
            'boolean' => 'Le champ :attribute doit être vrai ou faux.',
            'in' => 'Le champ :attribute doit être l\'un des suivants : :values.',
        ], [
            'titre' => 'titre',
            'description' => 'description',
            'adresse' => 'adresse',
            'ville' => 'ville',
            'prix' => 'prix',
            'nombre_de_chambres' => 'nombre de chambres',
            'nombre_de_salles_de_bain' => 'nombre de salles de bain',
            'superficie' => 'superficie',
            'type_de_bien' => 'type de bien',
            'nombre_de_lits' => 'nombre de lits',
            'capacite_max' => 'capacité max',
            'wifi' => 'WiFi',
            'parking' => 'parking',
            'climatisation' => 'climatisation',
            'chauffage' => 'chauffage',
            'cuisine' => 'cuisine',
            'animaux_acceptes' => 'animaux acceptés',
        ]);

        try {
            $bienImmobilier = BienImmobilier::findOrFail($id);
            $bienImmobilier->update(array_merge($validated, ['status' => 'En Attente']));

            return redirect()->route('client_bailleur.index')
                ->with('success', 'Le bien immobilier "' . $bienImmobilier->titre . '" a été mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour du bien immobilier "' . $bienImmobilier->titre . '".');
        }
    }

    public function destroy($id)
    {
        $bienImmobilier = BienImmobilier::findOrFail($id);
        $bienImmobilier->delete();
        return redirect()->route('client_bailleur.index')
            ->with('success', 'Le bien immobilier "' . $bienImmobilier->titre . '" a été supprimé avec succès.');
    }

    public function show($id)
    {
        $bien = BienImmobilier::with('datesIndisponibles')->findOrFail($id);
        return view('client_bailleur.show', compact('bien'));
    }

    public function edit($id)
    {
        $bienImmobilier = BienImmobilier::findOrFail($id);
        return view('client_bailleur.edit', compact('bienImmobilier'));
    }

    public function reservations()
    {
        $bailleur = Auth::user()->clientBailleur;
        $reservations = Reservation::whereHas('bienImmobilier', function($query) use ($bailleur) {
            $query->where('client_bailleur_id', $bailleur->id);
        })->with('bienImmobilier')->get();

        return view('client_bailleur.reservations', compact('reservations'));
    }

    public function cancelReservation($id)
    {
        $bailleur = Auth::user()->clientBailleur;
        $reservation = Reservation::whereHas('bienImmobilier', function($query) use ($bailleur) {
            $query->where('client_bailleur_id', $bailleur->id);
        })->where('id', $id)->firstOrFail();
        $reservation->delete();

        return redirect()->route('client_bailleur.reservations')->with('success', 'Réservation annulée avec succès.');
    }

    public function acceptReservation($id)
    {
        $bailleur = Auth::user()->clientBailleur;
        $reservation = Reservation::whereHas('bienImmobilier', function($query) use ($bailleur) {
            $query->where('client_bailleur_id', $bailleur->id);
        })->where('id', $id)->firstOrFail();

        $reservation->statut = 'Validé';
        $reservation->save();

        return redirect()->route('client_bailleur.reservations')->with('success', 'Réservation acceptée avec succès.');
    }


    public function addUnavailableDate(Request $request, $id)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ], [
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after_or_equal' => 'La date de fin doit être après ou égale à la date de début.',
        ]);

        try {
            $bienImmobilier = BienImmobilier::findOrFail($id);
            DateIndisponible::create([
                'bien_immobilier_id' => $bienImmobilier->id,
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'],
            ]);

            return redirect()->route('client_bailleur.show', $bienImmobilier->id)
                ->with('success', 'La disponibilité a été ajoutée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'ajout de la disponibilité: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'ajout de la disponibilité.');
        }
    }
}
