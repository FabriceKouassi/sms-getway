@extends('_.app')
@section('content')

<div class="layout-page">

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Enregistrer l' {{ $title }}</h5>
                      {{-- <small class="text-muted float-end">Merged input group</small> --}}
                    </div>
                    <div class="card-body">
                      <form action="{{ route('annonce.save') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Type Annonce" class="form-label">Choisir le model de SMS</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="typeSMS">
                                    <option selected="" @disabled(true)>Selectionner le type</option>
                                    @foreach ($typeSMS as $item)
                                        <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Titre de l'annonce</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Saisir le titre de l'annonce" name="titre" aria-label="Saisir le titre de l'annonce" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="message">Détail de l'annonce</label>
                            <div class="input-group input-group-merge speech-to-text">
                                <textarea class="form-control" placeholder="Saisir le détail (champ non obligatoire)" rows="6" name="details"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Type Annonce" class="form-label">Choisir les parents concernés</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="parents[]" multiple>
                                    @foreach ($parents as $item)
                                        <option value="{{ $item->id }}">{{ $item->nom }} {{ $item->prenoms }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{ route('annonce.all')}}">Retour</a>
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
