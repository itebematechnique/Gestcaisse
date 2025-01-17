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
                                <li class="breadcrumb-item"><a class="text-primary" href="#">Approvisionner la caisse</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('besoins.index.accepte') }}" class="btn btn-sm btn-primary">Liste</a>
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
                <i class="ni ni-air-baloon"></i> Rendez effectif le mouvement d'argent via le formulaire ci-dessous
                <br>
                <span>Vous pouvez ajouter une ramarque ou faire une descripton afin de pouvoir vous retrouver plus tard</span>
            </div>
        </div>
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Approvisionner la caisse</h3>
        </div>
        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <form role="form" method="POST" action="{{ route('besoins.approvisionner', $besoin) }}">
                    @csrf

                    {{-- Source --}}
                    <div class="form-group{{ $errors->has('source') ? ' has-danger' : '' }} mb-3">Source de financement
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                            </div>
                            <select class="form-control{{ $errors->has('source') ? ' is-invalid' : '' }}" name="source" id="source-select" required autofocus>
                                @foreach ($sources as $source)
                                    @if ($loop->index == 0)
                                        <option value="{{$source->source}}" selected>{{$source->source}}</option>
                                    @else
                                        <option value="{{$source->source}}">{{$source->source}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Bénéficiaire --}}
                    <div class="form-group{{ $errors->has('beneficiaire') ? ' has-danger' : '' }} mb-3">Bénéficiaire
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            </div>
                            <select class="form-control{{ $errors->has('beneficiaire') ? ' is-invalid' : '' }}" name="beneficiaire" id="beneficiaire-select" required autofocus>
                                @foreach ($beneficiaires as $beneficiaire)
                                    @if ($loop->index == 0)
                                        <option value="{{$beneficiaire->benef}}" selected>{{$beneficiaire->benef}}</option>
                                    @else
                                        <option value="{{$beneficiaire->benef}}">{{$beneficiaire->benef}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Motif --}}
                    <div class="form-group{{ $errors->has('motif') ? ' has-danger' : '' }} mb-3">Motif
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                            </div>
                            <select class="form-control{{ $errors->has('motif') ? ' is-invalid' : '' }}" name="motif" id="motif-select" required autofocus disabled>
                                @foreach ($motifs as $motif)
                                    @if ($motif->motif == $besoin->designation)
                                        <option value="{{$motif->motif}}" selected>{{$motif->motif}}</option>
                                    @else
                                        <option value="{{$motif->motif}}">{{$motif->motif}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Date --}}
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }} mb-3">Date
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Montant demandé') }}" type="date" name="date" value="{{ $besoin->date }}"
                                required autofocus disabled>
                        </div>
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- Montant demandé --}}
                    <div class="form-group{{ $errors->has('mt_d') ? ' has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('mt_d') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Montant demandé') }}" type="number" name="mt_d" value="{{ $besoin->montant }}"
                                required autofocus disabled>
                        </div>
                        @if ($errors->has('mt_d'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('mt_d') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- Montant accordé --}}
                    <div class="form-group{{ $errors->has('mt_a') ? ' has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('mt_a') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Montant accordé') }}" type="number" name="mt_a" value="{{ $besoin->montant_accorde }}"
                                required autofocus disabled>
                        </div>
                        @if ($errors->has('mt_a'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('mt_a') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- Moyen de paiement --}}
                    <div class="form-group{{ $errors->has('moyen') ? ' has-danger' : '' }} mb-3">Moyen de paiement
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                            </div>
                            <select class="form-control{{ $errors->has('moyen') ? ' is-invalid' : '' }}" name="moyen" id="moyen-select" required autofocus>
                                <option value="espèce" selected>Espèce</option>
                                <option value="chèque">Chèque</option>
                                <option value="billet à ordre">Billet à ordre</option>
                                <option value="autres">Autres</option>

                            </select>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }} mb-3">Description
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                            </div>
                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}"
                                name="description" id="" cols="30" rows="4" autofocus></textarea>
                        </div>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- Remarques --}}
                    <div class="form-group{{ $errors->has('remarque') ? ' has-danger' : '' }} mb-3">Remarques
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                            </div>
                            <textarea class="form-control{{ $errors->has('remarque') ? ' is-invalid' : '' }}" placeholder="{{ __('Remarque') }}"
                                name="remarque" id="" cols="30" rows="4" autofocus></textarea>
                        </div>
                        @if ($errors->has('remarque'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('remarque') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">{{ __('Approvisionner') }}</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection
