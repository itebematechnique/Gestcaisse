<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

// Models
use App\Models\Entree;
use App\Models\Source;
use App\Models\Beneficiaire;
use App\Models\Motif;



class EntreeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The index
    public function index(Request $request)
    {
        $actions = explode('-', auth()->user()->actions_entrees);

        $entrees = Entree::orderByDesc('date')->paginate(15);
        $links = $entrees->links()->elements[0];

        return view("pages.entree.index", compact("entrees", "links", 'actions'));
    }

    public function create()
    {
        $sources = Source::all();
        $beneficiaires = Beneficiaire::all();
        $motifs = Motif::all();

        return view("pages.entree.create", compact('sources', 'beneficiaires', 'motifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mt_d' => 'required | numeric',
            'mt_a' => 'required | numeric',
        ]);

        if($request->mt_a <= 0 || $request->mt_d <= 0)
                return Redirect::back()->withFail("Le montant doit être supérieur à 0");
        if($request->mt_a > $request->mt_d)
            return Redirect::back()->withFail("Le montant accordé ne doit pas dépasser le montant demandé");

        // Simple insertion
        $entree = new Entree();
        $entree->source = $request->source;
        $entree->beneficiaire = $request->beneficiaire;
        $entree->motif = $request->motif;
        $entree->date = date('Y-m-d');
        $entree->mt_d = $request->mt_d;
        $entree->mt_a = $request->mt_a;
        $entree->type_paye = $request->moyen;
        $entree->description = $request->description;
        $entree->remarque = $request->remarque;
        $entree->save();

        return Redirect::back()->withSuccess("L'entrée de $entree->mt_d FCFA a été ajoutée avec succès");
    }

    public function edit(Request $request, Entree $entree)
    {
        $sources = Source::all();
        $beneficiaires = Beneficiaire::all();
        $motifs = Motif::all();

        return view("pages.entree.edit", compact('entree', 'sources', 'beneficiaires', 'motifs'));
    }

    public function update(Request $request, Entree $entree)
    {
        // Simple update
        $entree->source = $request->source;
        $entree->beneficiaire = $request->beneficiaire;
        $entree->motif = $request->input('motif');
        $entree->mt_d = $request->input('mt_d');
        $entree->mt_a = $request->input('mt_a');
        $entree->type_paye = $request->moyen;
        $entree->description = $request->description;
        $entree->remarque = $request->remarque;

        $entree->save();

        return Redirect::back()->withSuccess("L'entrée de $entree->mt_d FCFA modifiée avec succès");
    }

    public function destroy(Entree $entree)
    {
        $entree->delete();
        return Redirect::back()->withFail("L'entrée a été supprimé avec succès");
    }
}
