@extends('_.app')
@section('content')

<div class="layout-page">

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Enregistrer la {{ $title }}</h5>
                      {{-- <small class="text-muted float-end">Merged input group</small> --}}
                    </div>
                    <div class="card-body">
                      <form action="{{ route('classe.save') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Saisir le libelle" name="nom" aria-label="Saisir la classe" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>
                        <a href="{{ route('classe.all')}}">Retour</a>
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
