<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

// Models
use App\Models\Motif;

class MotifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The index
    public function index(Request $request)
    {
        $motifs = Motif::paginate(15);
        $links = $motifs->links()->elements[0];

        return view("pages.motif.index", compact("motifs", "links"));
    }

    public function create()
    {
        return view("pages.motif.create");
    }

    public function store(Request $request)
    {
        // Simple insertion
        $motif = new Motif();
        $motif->motif = $request->input("motif");
        $motif->save();

        return Redirect::back()->withSuccess("Le motif $motif->motif a été ajouté avec succès");
    }

    public function edit(Request $request, Motif $motif)
    {
        return view("pages.motif.edit", compact('motif'));
    }

    public function update(Request $request, Motif $motif)
    {
        // Simple update
        $motif->motif = $request->input("motif");
        $motif->save();

        return Redirect::back()->withSuccess("Le motif $motif->motif a été modifié avec succès");
    }

    public function destroy(Motif $motif)
    {
        $motif->delete();
        return Redirect::back()->withFail("Le motif a été supprimé avec succès");
    }
}
