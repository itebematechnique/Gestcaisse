<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

// Models
use App\Models\Entree;
use App\Models\Source;
use App\Models\Beneficiaire;
use App\Models\Motif;
use App\Models\Depense;

class DepenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The index
    public function index(Request $request)
    {
        // User's actions
        // With array search should be different from false
        $actions = explode('-', auth()->user()->actions_depenses);

        $depenses = Depense::where('nbr_approuve', '=', 2)->orderByDesc('date')->paginate(15);
        $links = $depenses->links()->elements[0];

        return view("pages.depense.index", compact("depenses", "links", "actions"));
    }

    public function index_attente(Request $request)
    {
        // User's actions
        // With array search should be different from false
        $actions = explode('-', auth()->user()->actions_depenses);

        $depenses = Depense::where('nbr_approuve', '!=', 2)->orderByDesc('date')->paginate(15);
        $links = $depenses->links()->elements[0];

        return view("pages.depense.index_attente", compact("depenses", "links", "actions"));
    }

    public function create()
    {
        $beneficiaires = Beneficiaire::all();

        return view("pages.depense.create", compact('beneficiaires'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'montant' => 'required | numeric',
        ]);

        $entries_sum = Entree::sum('mt_a');
        $outings_sum = Depense::where('nbr_approuve', 2)->sum('mt');
        $balance = $entries_sum-$outings_sum;

        if($request->montant <= 0)
                return Redirect::back()->withFail("Le montant doit être supérieur à 0");
        if($request->montant > $balance)
                return Redirect::back()->withFail("Le montant doit être inférieur à $balance FCFA");

        // Simple insertion
        $depense = new Depense();
        $depense->beneficiaire = $request->beneficiaire;
        $depense->date = date('Y-m-d');
        $depense->motif = $request->motif;
        $depense->mt = $request->montant;
        $depense->nbr_approuve = 0;
        $depense->sortie_approuve = 0;
        $depense->save();

        return Redirect::back()->withSuccess("La depense $depense->motif s'élevant à $request->montant FCFA a été ajoutée avec succès");
    }

    public function edit(Request $request, Depense $depense)
    {
        $beneficiaires = Beneficiaire::all();

        return view("pages.depense.edit", compact('depense', 'beneficiaires'));
    }

    public function update(Request $request, Depense $depense)
    {
        // Simple update
        // Validation
        $request->validate([
            'montant' => 'required | numeric',
        ]);

        $entries_sum = Entree::sum('mt_a');
        $outings_sum = Depense::where('nbr_approuve', 2)->sum('mt');
        $balance = $entries_sum-$outings_sum;
        $balance = $balance+$depense->mt;

        if($request->montant <= 0)
                return Redirect::back()->withFail("Le montant doit être supérieur à 0");
        if($request->montant > $balance)
                return Redirect::back()->withFail("Le montant doit être inférieur à $balance FCFA");

        $depense->beneficiaire = $request->beneficiaire;
        $depense->date = $request->date;
        $depense->motif = $request->motif;
        $depense->mt = $request->montant;
        $depense->save();

        return Redirect::back()->withSuccess("La dépense $request->motif a été modifiée avec succès");
    }

    public function destroy(Depense $depense)
    {
        $depense->delete();
        return Redirect::back()->withFail("La dépense a été supprimée avec succès");
    }

    public function approuve(Request $request, Depense $depense)
    {
        $depense->sortie_approuve = 1;
        $depense->nbr_approuve = $depense->nbr_approuve+1;
        $depense->id_person_approuve = auth()->user()->id;
        $depense->save();

        return Redirect::back()->withSuccess("La dépense a été approuvée avec succès");
    }
}
