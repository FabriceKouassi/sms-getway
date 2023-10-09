@extends('_.app')
@section('content')

<div class="layout-page">

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Enregistrer le {{ $title }}</h5>
                      {{-- <small class="text-muted float-end">Merged input group</small> --}}
                    </div>
                    <div class="card-body">
                      <form action="{{ route('professeur.save') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Type SMS" class="form-label">Choisir la matière</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="matiere">
                                    <option selected="">Selectionner la matière</option>
                                    @foreach ($matieres as $item)
                                        <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Saisir le libelle" name="nom" aria-label="Saisir la matiere" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Prénoms</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Saisir le libelle" name="prenoms" aria-label="Saisir la matiere" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="Contact">Contact</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="number" class="form-control" id="basic-icon-default-fullname" placeholder="Saisir le contact" name="contact" aria-label="Saisir le contact" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>
                        <a href="{{ route('professeur.all')}}">Retour</a>
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
