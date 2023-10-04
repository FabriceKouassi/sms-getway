@extends('_.app')
@section('content')

<div class="layout-page">

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <a class="btn btn-primary" href="{{ route('sms.saveForm') }}"><span class="icon-style">+</span> Ajouter votre {{ $title }}</a>
            <div class="card mt-3">
                <main class="cd__main">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Messages</th>
                                <th>Types</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sms as $item)
                                <tr>
                                    <td>{{ $item->message }}</td>
                                    <td>{{ $item->typeSms->libelle }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#saveModal">
                                            Message
                                        </button> --}}
                                        <a class="btn btn-primary" href="{{ route('sms.updateForm', [$item->id]) }}"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                                        <a class="btn btn-warning" href="{{ route('sms.delete', [$item->id]) }}"><i class="bx bx-trash me-1"></i> Suprimer</a>
                                    </td>
                                </tr>
                            @endforeach
                        <tbody>
                    </table>
                </main>
            </div>
        </div>

        <div class="mt-3">
            <!-- Modal -->
            <div class="modal fade" id="saveModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content" method="POST" action="{{ route('sms.save') }}" id="saveForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="saveModalTitle">Créer type de sms</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="libelle" class="form-label">Libelle</label>
                                    <input type="text" id="libelle" class="form-control" name="libelle" placeholder="Enter le Libelle">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Fermer
                            </button>
                            <button type="button" class="btn btn-primary" id="saveModalBTN">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        @include('_.footer')

        <div class="content-backdrop fade"></div>
    </div>

</div>
@endsection
