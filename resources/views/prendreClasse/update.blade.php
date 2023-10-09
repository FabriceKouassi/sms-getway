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
                            <a href="{{ route('prendreClasse.all')}}" class="btn btn-default"><span class="icon-style"><- </span>Retour</a>
                        </small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('prendreClasse.save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="Type SMS" class="form-label">Choisir le professeur</label>
                                        <div class="input-group input-group-merge">
                                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="professeur">
                                                <option selected="" disabled>Selectionner le professeur</option>
                                                @foreach ($professeur_classe as $item)
                                                    <option value="{{ $item->professeurs->id }}" {{ (int) $item->professeurs->id === (int) $item->professeur_id ? 'selected="selected"' : "" }}>
                                                        {{ $item->professeurs->nom }} {{ $item->professeurs->prenoms }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="Classe" class="form-label">Choisir la classe</label>
                                        <div class="input-group input-group-merge" style="height: 350px;">
                                            <select multiple="" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="classes[]">
                                                <option selected="" disabled>Selectionner la classe</option>
                                                {{-- @foreach ($typeSms as $item)
                                                    <option value="{{ $item->id}}" {{ (int) $sms->typesms_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                                        {{ $item->libelle }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('prendreClasse.all')}}">Retour</a>
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
