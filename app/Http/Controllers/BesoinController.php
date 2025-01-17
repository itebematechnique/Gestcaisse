<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

// Models
use App\Models\Besoin;
use App\Models\Entree;
use App\Models\Source;
use App\Models\Beneficiaire;
use App\Models\Motif;

class BesoinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The index
    public function index(Request $request)
    {
        $actions = explode('-', auth()->user()->actions_besoins);

        $besoins = Besoin::where([
            'payement' => null,
            'status' => null
        ])->paginate(15);
        $links = $besoins->links()->elements[0];

        return view("pages.besoin.index", compact('besoins', 'links', 'actions'));
    }

    public function index_accepte(Request $request)
    {
        $actions = explode('-', auth()->user()->actions_besoins);

        $besoins_sum = $besoins = Besoin::where([
            'status' => 'accepté'
        ])->sum('montant_accorde');
        $besoins = Besoin::where([
            'status' => 'accepté'
        ])->orderByDesc('date')->paginate(15);
        $links = $besoins->links()->elements[0];

        return view("pages.besoin.index_accepte", compact('besoins', 'links', 'besoins_sum', 'actions'));
    }

    public function index_refuse(Request $request)
    {
        $actions = explode('-', auth()->user()->actions_besoins);

        $besoins = Besoin::where([
            'status' => 'refusé'
        ])->orderByDesc('date')->paginate(15);
        $links = $besoins->links()->elements[0];

        return view("pages.besoin.index_refuse", compact('besoins', 'links', 'actions'));
    }

    public function index_attente(Request $request)
    {
        $actions = explode('-', auth()->user()->actions_besoins);

        $besoins_count = Besoin::where([
            'status' => 'en attente'
        ])->count();
        $besoins = Besoin::where([
            'status' => 'en attente'
        ])->orderByDesc('date')->paginate(15);
        $links = $besoins->links()->elements[0];

        return view("pages.besoin.index_attente", compact('besoins', 'links', 'besoins_count', 'actions'));
    }

    public function index_approvisionner(Request $request, Besoin $besoin)
    {
        $actions = explode('-', auth()->user()->actions_besoins);
        $sources = Source::all();
        $beneficiaires = Beneficiaire::all();
        $motifs = Motif::all();

        return view("pages.besoin.index_approvisionner", compact('besoin', 'sources', 'beneficiaires', 'motifs', 'actions'));
    }

    public function create()
    {
        $motifs = Motif::all();
        return view("pages.besoin.create", compact('motifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motif' => 'required',
            'montant' => 'required | numeric'
        ]);
        if($request->montant <= 0)
            return Redirect::back()->withFail("Le montant demandé doit être supérieur à 0");
        // Simple insertion
        $besoin = new Besoin();
        $besoin->designation = $request->input("motif");
        $besoin->montant = $request->input("montant");
        $besoin->status = 'en attente';
        $besoin->payement = 0;
        $besoin->date = date('Y-m-d');
        $besoin->mois = $request->input('mois');
        $besoin->auteur = auth()->user()->username;
        $besoin->save();

        return Redirect::back()->withSuccess("Le besoin $besoin->designation s'élevant à $besoin->montant FCFA a été ajouté avec succès");
    }

    public function edit(Request $request, Besoin $besoin)
    {
        $motifs = Motif::all();
        return view("pages.besoin.edit", compact('besoin', 'motifs'));
    }

    public function update(Request $request, Besoin $besoin)
    {
        // Simple update
        $request->validate([
            'motif' => 'required',
            'montant' => 'required | numeric',
            'mois' => 'nullable'
        ]);
        if($request->montant <= 0)
            return Redirect::back()->withFail("Le montant demandé doit être supérieur à 0");
        $besoin->designation = $request->input("motif");
        $besoin->mois = $request->input('mois');
        $besoin->montant = $request->input("montant");
        $besoin->status = 'en attente';
        $besoin->payement = 0;
        $besoin->date = date('Y-m-d');
        $besoin->auteur = auth()->user()->username;
        $besoin->save();

        return Redirect::back()->withSuccess("Le besoin $besoin->besoin a été modifié avec succès");
    }

    public function validation(Request $request, Besoin $besoin)
    {
        if($request->validation_type == 'valider'){
            if($request->montant <= 0)
                return Redirect::back()->withFail("Le montant accordé doit être supérieur à 0");
            if($request->montant > $besoin->montant)
                return Redirect::back()->withFail("Le montant accordé ne doit pas dépasser le montant demandé");

            $besoin->status = 'accepté';
            $besoin->montant_accorde = $request->montant;
            $besoin->save();

            return Redirect::back()->withSuccess("Le besoin $besoin->besoin a été validé avec succès");
        }else {
            $besoin->status = 'refusé';
            $besoin->save();
            return Redirect::back()->withFail("Le besoin $besoin->besoin a été rejeté avec succès");
        }
    }

    public function destroy(Besoin $besoin)
    {
        $besoin->delete();
        return Redirect::back()->withFail("Le besoin a été supprimé avec succès");
    }

    public function approvisionner(Request $request, Besoin $besoin)
    {
        // Simple insertion
        $entree = new Entree();
        $entree->source = $request->source;
        $entree->beneficiaire = $request->beneficiaire;
        $entree->motif = $request->motif;
        $entree->date = date('Y-m-d');
        $entree->mt_d = $besoin->montant;
        $entree->mt_a = $besoin->montant_accorde;
        $entree->type_paye = $request->moyen;
        $entree->description = $request->description;
        $entree->remarque = $request->remarque;
        $entree->save();

        $besoin->payement = 1;
        $besoin->date_approv = date('Y-m-d');
        $besoin->save();

        return Redirect::back()->withSuccess("Le besoin a été approuvé avec succès");
    }
}
