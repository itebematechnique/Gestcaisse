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
                        <h6 class="h2 text-white d-inline-block mb-0">Besoins</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
{{--                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>--}}
                                <li class="breadcrumb-item"><a href="#">Liste des besoins</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('besoins.create') }}" class="btn btn-sm btn-neutral">Nouveau</a>
                        @if (auth()->user()->role == 'directeur')
                            <a href="{{ route('besoins.create') }}" class="btn btn-sm btn-neutral">Traiter les besoins</a>
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
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Liste des besoins</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive pb-3 pt-3">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Motif</th>
                        <th scope="col" class="sort" data-sort="name">Montant demandé</th>
                        <th scope="col" class="sort" data-sort="name">Montant accordé</th>
                        <th scope="col" class="sort" data-sort="name">Etat du paiement</th>
                        <th scope="col" class="sort" data-sort="name">Statut du besoin</th>
                        <th scope="col" class="sort" data-sort="name">Date d'expression</th>
                        <th scope="col" class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($besoins as $besoin)
                    <tr>
                        <td class="media-body">
                            {{ $besoin->designation }}
                        </td>
                        <td class="budget">
                            {{ $besoin->montant }}
                        </td>
                        <td class="budget">
                            {{ $besoin->montant_accorde }}
                        </td>
                        <td class="budget">
                            @if ($besoin->payement == 0)
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-warning"></i>
                                    <span class="status">En attente</span>
                                </span>
                            @else
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-success"></i>
                                    <span class="status">Effectué</span>
                                </span>
                            @endif
                        </td>
                        <td class="budget">
                            {{ $besoin->status }}
                        </td>
                        <td class="budget">
                            {{ $besoin->date }}
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href={{ route('besoins.edit', $besoin) }}>Approvisionner la caisse</a>

                                    @if ($besoin->status == 'en attente')
                                        <a class="dropdown-item" href={{ route('besoins.edit', $besoin) }}>Modifier</a>
                                    @endif

                                    {{-- <form action={{ route('besoins.destroy', $besoin) }} method="post" id="delete-besoin">
                                        @method('DELETE')
                                        <button class="dropdown-item" type="submit">Supprimer</button>
                                        @csrf
                                    </form> --}}
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


                            <a class="page-link" href="{{ $link}}">{{ $loop->index+1 }}</a>
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
