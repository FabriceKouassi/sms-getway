@extends('_.app')
@section('content')

<div class="layout-page">

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Enregistrer le Type de SMS</h5>
                      <small class="text-muted float-end">
                            <a href="{{ route('parent.all')}}" class="btn btn-default"><span class="icon-style"><- </span>Retour</a>
                      </small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('parent.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="hidden" class="form-control" value="{{ $parent->id }}" id="basic-icon-default-fullname" placeholder="Saisir le nom" name="dataID" aria-label="Saisir le nom" aria-describedby="basic-icon-default-fullname2">
                                    <input type="text" class="form-control" value="{{ $parent->nom }}" id="basic-icon-default-fullname" placeholder="Saisir le nom" name="nom" aria-label="Saisir le nom" aria-describedby="basic-icon-default-fullname2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Prénoms</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" value="{{ $parent->prenoms }}" id="basic-icon-default-fullname" placeholder="Saisir le prenoms" name="prenoms" aria-label="Saisir le prenoms" aria-describedby="basic-icon-default-fullname2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Contact</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" value="{{ $parent->contact }}" id="basic-icon-default-fullname" placeholder="Saisir le contact" name="contact" aria-label="Saisir le contact" aria-describedby="basic-icon-default-fullname2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Adresse</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" value="{{ $parent->adresse }}" id="basic-icon-default-fullname" placeholder="Saisir l'adresse" name="adresse" aria-label="Saisir l'adresse" aria-describedby="basic-icon-default-fullname2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Adresse</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" value="{{ $parent->email }}" id="basic-icon-default-fullname" placeholder="Saisir l'email" name="email" aria-label="Saisir l'email" aria-describedby="basic-icon-default-fullname2">
                                </div>
                            </div>
                            <a href="{{ route('parent.all')}}">Retour</a>
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
