@extends('layouts.app')

@section('content')
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                </div>
            </div>
        </nav>
    </div>
    {{-- HEADER --}}
    <div class="header bg-primary pb-4 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Entrées</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
{{--                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>--}}
                                <li class="breadcrumb-item"><a href="#" class="text-primary">Liste des entrées</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        @if (array_search("AE", $actions) != false || $actions["0"] == "AE")
                            <a href="{{ route('entrees.create') }}" class="btn btn-sm btn-primary">Nouvelle</a>
                        @endif
                        {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('fail'))
    <div class="alert alert-danger">
        {{Session::get('fail')}}
    </div>
@endif

    {{-- TABLE --}}
    <div class="card">
        {{--    TOOLTIP--}}
        <div class="card card-frame mx-2 my--2 text-sm border-primary bg-primary-lighter">
            <div class="card-body text-primary">
                <i class="ni ni-air-baloon"></i> La liste des entrées vous permet d'identifier la quantité d'argent injectée dans le système... Cette action est irréversible !
                <br>
                <span>Vous pouvez à tout moment modifier l'entrée en question !</span>
                <br>
                <span>Vous êtes sur la page <strong> {{ request()->get('page', 1) }} </strong></span>
            </div>
        </div>

        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Liste des entrées</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive pb-3 pt-3">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Source</th>
                        <th scope="col" class="sort" data-sort="name">Bénéficiaire</th>
                        <th scope="col" class="sort" data-sort="name">Motif</th>
                        <th scope="col" class="sort" data-sort="name">Date</th>
                        <th scope="col" class="sort" data-sort="name">Montant demandé</th>
                        <th scope="col" class="sort" data-sort="name">Description</th>
                        <th scope="col" class="sort" data-sort="name">Montant accordé</th>
                        <th scope="col" class="sort" data-sort="name">Remarques</th>
                        <th scope="col" class="sort" data-sort="name">Moyen de paiement</th>
                        <th scope="col" class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($entrees as $entree)
                    <tr>
                        <td class="budget">
                            {{ $entree->source}}
                        </td>
                        <td class="budget">
                            {{ $entree->beneficiaire}}
                        </td>
                        <td class="budget">
                            {{ $entree->motif}}
                        </td>
                        <td class="budget">
                            {{ ucwords(\Carbon\Carbon::parse($entree->date)->locale('fr')->translatedFormat('l d F Y')) }}
                        </td>
                        <td class="budget">
                            {{ number_format($entree->mt_d) }} FCFA
                        </td>
                        <td class="budget">
                            {{ $entree->description}}
                        </td>
                        <td class="budget">
                            {{ number_format($entree->mt_a)}} FCFA
                        </td>
                        <td class="budget">
                            {{ $entree->remarque}}
                        </td>
                        <td class="budget">
                            {{ $entree->type_paye}}
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    @if (array_search("EE", $actions) != false || $actions["0"] == "EE")
                                        <a class="dropdown-item" href={{ route('entrees.edit', $entree) }}>Mettre à jour</a>
                                    @endif

                                    {{--@if (array_search("SE", $actions) != false || $actions["0"] == "SE")
                                        <form action={{ route('entrees.destroy', $entree) }} method="post" id="delete-entree">
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger" type="submit"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir retirer l\'entrée de <{{ number_format($entree->mt_a)}}> XOF  pour <{{ $entree->motif}}> ?')">Retirer</button>
                                            @csrf
                                        </form>
                                    @endif--}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Card footer -->
        <div class="card-footer py-4">
            <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                    {{-- <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">
                            <i class="fas fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li> --}}
                    @foreach ($links as $link)
                        <li class="page-item">
                            <a class="page-link {{ request()->get('page', 1) == $loop->index+1 ? 'bg-primary text-white' : 'bg-white text-primary' }}" href="{{ $link }}">{{ $loop->index+1 }}</a>
                        </li>
                    @endforeach
                    {{-- <li class="page-item">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li> --}}

                    {{-- <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fas fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </li> --}}
                </ul>
            </nav>
        </div>
    </div>
@endsection
