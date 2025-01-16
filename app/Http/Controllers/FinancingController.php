<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

// Models
use App\Models\Source;

class FinancingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The index
    public function index(Request $request)
    {
        $sources = Source::paginate(15);
        $links = $sources->links()->elements[0];

        return view("pages.source.index", compact("sources", "links"));
    }

    public function create()
    {
        return view("pages.source.create");
    }

    public function store(Request $request)
    {
        // Simple insertion
        $source = new Source();
        $source->source = $request->input("source");
        $source->save();

        return Redirect::back()->withSuccess("La source $source->source a été ajoutée avec succès");
    }

    public function edit(Request $request, Source $source)
    {
        return view("pages.source.edit", compact('source'));
    }

    public function update(Request $request, Source $source)
    {
        // Simple update
        $source->source = $request->input("source");
        $source->save();

        return Redirect::back()->withSuccess("La source $source->source a été modifiée avec succès");
    }

    public function destroy(Source $source)
    {
        $source->delete();
        return Redirect::back()->withFail("La source a été supprimée avec succès");
    }
}
