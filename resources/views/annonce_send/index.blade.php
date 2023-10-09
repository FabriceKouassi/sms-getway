@extends('_.app')
@section('content')

<div class="layout-page">

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <a class="btn btn-primary" href="{{ route('annonce.saveForm') }}"><span class="icon-style">+</span> Ajouter l'{{ $title }}</a>

            <div class="row">
                <div class="col">
                    <form action="{{ route('annonce.mail') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Type Annonce" class="form-label my-3">Annonces en attente d'envois</label>
                            <div class="input-group input-group-merge h-600">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="annonces[]" multiple>
                                    @foreach ($annonce_en_attente as $item)
                                        <option value="{{ $item->parent->id }}">
                                            {{ $item->parent->nom }} {{ $item->parent->prenoms }} |
                                            {{ $item->parent->email }} | {{ ($item->sms->typeSms->libelle == null) ? '' : $item->sms->typeSms->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <a class="btn btn-warning" href="{{ route('annonce.saveForm') }}"><span class="icon-style"></span> Envoyez les annonces</a> --}}
                        <button type="submit" class="btn btn-warning" {{ $annonce_en_attente->count() === 0 ? 'disabled': '' }}>Envoyez les annonces</button>
                    </form>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="Type Annonce" class="form-label my-3">Annonces envoyées</label>
                        <div class="input-group input-group-merge h-600">
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="" multiple>
                                @foreach ($annonce_envoyee as $item)
                                    <option value="{{ $item->parent->id }}" disabled>
                                        {{ $item->parent->nom }} {{ $item->parent->prenoms }} | {{ $item->sms->typeSms->libelle }}
                                    </option>
                                @endforeach
                            </select>
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
