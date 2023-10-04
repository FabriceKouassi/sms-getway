@extends('_.app')
@section('content')

<div class="layout-page">

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Enregistrer l'{{ $title }}</h5>
                        <small class="text-muted float-end">
                            <a href="{{ route('eleve.all')}}" class="btn btn-default"><span class="icon-style"><- </span>Retour</a>
                        </small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('eleve.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="Type SMS" class="form-label">Choisir le parent</label>
                                        <div class="input-group input-group-merge">
                                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="parent">
                                                @foreach ($parent as $item)
                                                    <option value="{{ $item->id}}" {{ (int) $eleve->parent_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                                        {{ $item->nom }} {{ $item->prenoms }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="Type SMS" class="form-label">Choisir la classe</label>
                                        <div class="input-group input-group-merge">
                                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="classe">
                                                @foreach ($classe as $item)
                                                    <option value="{{ $item->id}}" {{ (int) $eleve->classe_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                                        {{ $item->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Matricule</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Saisir le matricule"
                                    name="matricule" aria-label="Saisir le matricule" aria-describedby="basic-icon-default-fullname2"
                                    value="{{ $eleve->matricule }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="hidden" class="form-control" value="{{ $eleve->id }}" id="basic-icon-default-fullname" placeholder="Saisir le nom" name="dataID" aria-label="Saisir le nom" aria-describedby="basic-icon-default-fullname2">
                                    <input type="text" class="form-control" value="{{ $eleve->nom }}" id="basic-icon-default-fullname" placeholder="Saisir le nom" name="nom" aria-label="Saisir le nom" aria-describedby="basic-icon-default-fullname2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Prénoms</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" value="{{ $eleve->prenoms }}" id="basic-icon-default-fullname" placeholder="Saisir le prenoms" name="prenoms" aria-label="Saisir le prenoms" aria-describedby="basic-icon-default-fullname2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Contact</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" value="{{ $eleve->contact }}" id="basic-icon-default-fullname" placeholder="Saisir le contact" name="contact" aria-label="Saisir le contact" aria-describedby="basic-icon-default-fullname2">
                                </div>
                            </div>
                            <a href="{{ route('eleve.all') }}">Retour</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>

    </div>

        @include('_.footer')

        <div class="content-backdrop fade"></div>
    </div>

</div>
@endsection
