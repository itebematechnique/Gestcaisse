<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

// Models
use App\Models\Entree;
use App\Models\Source;
use App\Models\Beneficiaire;
use App\Models\Motif;

class DepenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The index
    public function index(Request $request)
    {
        $depenses = Depense::paginate(15);
        $links = $depenses->links()->elements[0];

        return view("pages.depense.index", compact("depenses", "links"));
    }

    public function create()
    {
        return view("pages.depense.create");
    }

    public function store(Request $request)
    {
        // Simple insertion
        $depense = new Depense();
        $depense->depense = $request->input("depense");
        $depense->save();

        return Redirect::back()->withSuccess("Le depense $depense->depense a été ajouté avec succès");
    }

    public function edit(Request $request, Depense $depense)
    {
        return view("pages.depense.edit", compact('depense'));
    }

    public function update(Request $request, Depense $depense)
    {
        // Simple update
        $depense->depense = $request->input("depense");
        $depense->save();

        return Redirect::back()->withSuccess("Le depense $depense->depense a été modifié avec succès");
    }

    public function destroy(Depense $depense)
    {
        $depense->delete();
        return Redirect::back()->withFail("Le depense a été supprimé avec succès");
    }
}
