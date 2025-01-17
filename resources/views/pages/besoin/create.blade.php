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
                                <li class="breadcrumb-item"><a class="text-primary" href="#">Nouveau besoin</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('besoins.index.attente') }}" class="btn btn-sm btn-primary">Liste</a>
                        {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card">
        {{--    TOOLTIP--}}
        <div class="card card-frame mx-2 my--2 text-sm border-primary bg-primary-lighter">
            <div class="card-body text-primary">
                <i class="ni ni-air-baloon"></i> Vous avez à ce niveau la possibilité d'exprimer un besoin qui sera soumis à une validation
                <br>
                <i class="ni ni-air-baloon"></i> Spécifiez juste le motif, le mois et le montant voulu
                <br>
                <span>Vous êtes sur la page <strong> {{ request()->get('page', 1) }} </strong></span>
            </div>
        </div>
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Exprimer un besoin</h3>
        </div>
        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <form role="form" method="POST" action="{{ route('besoins.store') }}">
                    @csrf

                    <div class="form-group{{ $errors->has('motif') ? ' has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                            </div>
                            <select class="form-control{{ $errors->has('motif') ? ' is-invalid' : '' }}" name="motif" id="motif-select" required autofocus>
                                @foreach ($motifs as $motif)
                                    @if ($loop->index == 0)
                                        <option value="{{$motif->motif}}" selected>{{$motif->motif}}</option>
                                    @else
                                        <option value="{{$motif->motif}}">{{$motif->motif}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('motif'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('motif') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('mois') ? ' has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                            </div>
                            <select class="form-control{{ $errors->has('mois') ? ' is-invalid' : '' }}" name="mois" id="mois-select" autofocus>
                                @php
                                    // Array of months in French
                                    $months = [ 'Veuillez chosir le mois',
                                        'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                                        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                                    ];
                                @endphp

                                @foreach ($months as $month)
                                    <option value="{{ $month }}">
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('mois'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('mois') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('montant') ? ' has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('montant') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Montant') }}" type="number" name="montant" value="{{ old('montant') }}"
                                required autofocus>
                        </div>
                        @if ($errors->has('montant'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('montant') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">{{ __('Ajouter') }}</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection
