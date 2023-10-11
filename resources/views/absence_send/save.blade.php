@extends('_.app')
@section('content')

<div class="layout-page">

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                  @foreach ($classes_enseignes as $item)
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Absence concernant la classe <strong>{{ $item->classes->nom }}</strong></h5>
                        {{-- <small class="text-muted float-end">Merged input group</small> --}}
                        </div>
                        <div class="card-body">
                        <form action="{{ route('absence.save') }}" method="POST">
                            @csrf

                            <input type="hidden" name="classe_id" value="{{ (int) $item->classes->id }}">

                            <div class="mb-3">
                                <label for="Type Annonce" class="form-label">Sélectionner la matière</label>
                                <div class="input-group input-group-merge">
                                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="matiere">
                                        @foreach ($matieres as $matiere)
                                            <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="Type Annonce" class="form-label">Sélectionner les élèves absents</label>
                                <div class="input-group input-group-merge h-500">
                                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="absences[]" multiple>
                                        @foreach ($eleves as $eleve)
                                            <option value="{{ $eleve->id }}">{{ $eleve->nom }} {{ $eleve->prenoms }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <a href="{{ route('absence.all')}}">Retour</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                        </div>
                    </div>
                  @endforeach
                </div>
              </div>
        </div>

    </div>

    @include('_.footer')

    <div class="content-backdrop fade"></div>
</div>

</div>
@endsection
