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
                        <h6 class="h2 text-white d-inline-block mb-0">Dépenses</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
{{--                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>--}}
                                <li class="breadcrumb-item"><a href="#">Liste des dépenses en attente</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        @if (array_search("AD", $actions) != false || $actions["0"] == "AD")
                            <a href="{{ route('depenses.create') }}" class="btn btn-sm btn-neutral">Nouvelle</a>
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
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Liste des dépenses en attente</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive pb-3 pt-3">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">ID</th>
                        <th scope="col" class="sort" data-sort="name">Date</th>
                        <th scope="col" class="sort" data-sort="name">Beneficiaire</th>
                        <th scope="col" class="sort" data-sort="name">Motif</th>
                        <th scope="col" class="sort" data-sort="name">Montant</th>
                        <th scope="col" class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($depenses as $depense)
                    <tr>
                        <td class="budget">
                            {{ $depense->id}}
                        </td>
                        <td class="budget">
                            {{ ucwords(\Carbon\Carbon::parse($depense->date)->locale('fr')->translatedFormat('l d F Y')) }}
                        </td>
                        <td class="budget">
                            {{ $depense->beneficiaire}}
                        </td>
                        <td class="budget">
                            {{ $depense->motif}}
                        </td>
                        <td class="budget">
                            {{ number_format($depense->mt)}} FCFA
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                        @if (array_search("ED", $actions) != false || $actions["0"] == "ED")
                                            <a class="dropdown-item" href={{ route('depenses.edit', $depense) }}>Modifier</a>
                                        @endif

                                        @if ((array_search("APPROUVE", $actions) != false || $actions["0"] == "APPROUVE")
                                         && $depense->nbr_approuve != 2 && $depense->id_person_approuve != auth()->user()->id
                                        )
                                            <a class="dropdown-item" href={{ route('depenses.approuve', $depense) }}>Approuver</a>
                                        @endif

                                        @if (array_search("SD", $actions) != false || $actions["0"] == "SD")
                                            <form action={{ route('depenses.destroy', $depense) }} method="post" id="delete-depense">
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit">Supprimer</button>
                                                @csrf
                                            </form>
                                        @endif

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
