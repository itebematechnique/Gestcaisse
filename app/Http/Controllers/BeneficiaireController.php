<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

// Models
use App\Models\Beneficiaire;

class BeneficiaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The index
    public function index(Request $request)
    {
        $beneficiaires = Beneficiaire::paginate(15);
        $links = $beneficiaires->links()->elements[0];

        return view("pages.beneficiaire.index", compact("beneficiaires", "links"));
    }

    public function create()
    {
        return view("pages.beneficiaire.create");
    }

    public function store(Request $request)
    {
        // Simple insertion
        $beneficiaire = new Beneficiaire();
        $beneficiaire->benef = $request->input("beneficiaire");
        $beneficiaire->save();

        return Redirect::back()->withSuccess("Le beneficiaire $beneficiaire->benef a été ajoutée avec succès");
    }

    public function edit(Request $request, Beneficiaire $beneficiaire)
    {
        return view("pages.beneficiaire.edit", compact('beneficiaire'));
    }

    public function update(Request $request, Beneficiaire $beneficiaire)
    {
        // Simple update
        $beneficiaire->benef = $request->input("beneficiaire");
        $beneficiaire->save();

        return Redirect::back()->withSuccess("Le beneficiaire $beneficiaire->benef a été modifiée avec succès");
    }

    public function destroy(Beneficiaire $beneficiaire)
    {
        $beneficiaire->delete();
        return Redirect::back()->withFail("Le beneficiaire a été supprimée avec succès");
    }
}
