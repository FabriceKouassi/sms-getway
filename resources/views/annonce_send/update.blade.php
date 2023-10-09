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
                            <a href="{{ route('annonce.all')}}" class="btn btn-default"><span class="icon-style"><- </span>Retour</a>
                      </small>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('annonce.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">

                            <label for="Type SMS" class="form-label">Choisir le Type de SMS</label>
                            <div class="input-group input-group-merge">
                                <input type="hidden" class="form-control" name="dataID" value="{{ $annonce->id }}">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="annonce">
                                    @foreach ($typeAnnonce as $item)
                                        <option value="{{ $item->id}}" {{ (int) $annonce->typeannonce_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                            {{ $item->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Titre</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Saisir le titre"
                                    name="titre" aria-label="Saisir la matiere" aria-describedby="basic-icon-default-fullname2"
                                    value="{{ $annonce->titre }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="message">Description</label>
                            <div class="input-group input-group-merge speech-to-text">
                                <textarea class="form-control" placeholder="Saisir la description" rows="6" name="description">
                                    {{ $annonce->description }}
                                </textarea>
                            </div>
                        </div>
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
