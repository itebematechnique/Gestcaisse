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
                        <h6 class="h2 text-white d-inline-block mb-0">Sources de financement</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
{{--                                <li class="breadcrumb-item"><a href="{{ route('home')  }}"><i class="fas fa-home"></i></a></li>--}}
                                <li class="breadcrumb-item"><a href="#" class="text-primary">Mise à jour d'une source de financement</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('financings.index') }}" class="btn btn-sm btn-primary">Liste</a>
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

    {{-- TABLE --}}
    <div class="card">
        {{--    TOOLTIP--}}
        <div class="card card-frame mx-2 my--2 text-sm border-primary bg-primary-lighter">
            <div class="card-body text-primary">
                <i class="ni ni-air-baloon"></i> Effectuez la mise à jour de cette source
                <br>
                <span>Vous êtes sur la page <strong> {{ request()->get('page', 1) }} </strong></span>
            </div>
        </div>

        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Mettre à jour une source de financement</h3>
        </div>
        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <form role="form" method="POST" action={{ route('financings.update', $source) }}>
                    @method('PUT')
                    @csrf

                    <div class="form-group{{ $errors->has('source') ? ' has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('source') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('source') }}" type="text" name="source" value="{{ $source->source }}"
                                value="hacker" required autofocus>
                        </div>
                        @if ($errors->has('source'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('source') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">{{ __('Modifier') }}</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection
