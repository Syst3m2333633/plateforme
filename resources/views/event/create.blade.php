@extends('Layouts.layout')

@section('content')
    <div class="container">
        <div class="row card text-white bg-dark">
            <h4 class="card-header">Contactez-moi</h4>
            <div class="card-body">
                {{-- <form action="{{ route('event.store') }}" method="POST">{{--{{ url('event') }}--}}
                  {{-- @csrf --}}
                    {{-- @method('POST') --}}
                    <form action="{{ route('dropevent.store') }}" method="post" enctype="multipart/form-data"
                    id="image-upload" class="dropzone">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control  @error('titre') is-invalid @enderror" name="titre"
                            id="titre" placeholder="Votre titre" value="{{ old('titre') }}">
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control  @error('message') is-invalid @enderror" name="message" id="message"
                            placeholder="Votre message">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                    </div> --}}

                    <button type="submit" class="btn btn-secondary">Envoyer !</button>
                {{-- </form> --}}

                    <input type="file" class="dropzone form-control @error('file') is-invalid @enderror" name="file" id="file">
                    {{-- <div>
                        <h3>Ajout d'une ou de plusieurs pièces jointes</h3>
                    </div> --}}

                </form>
            </div>
        </div>
    </div>




























    {{-- <h3>Espace de déclaration d'évènement</h3>
    <form action="{{ route('event.store') }}" method="POST">
        @csrf
        @method('HEAD')

        <label>Titre : </label>
        <input type="text" name="titre" id="titre" placeholder="titre du message" /><br>
        <label>message : </label>
        <textarea name="message" id="message"></textarea><br>
        <input type="submit" value="Enregistrer" />

    </form>
    <form action="{{ route('dropevent.store') }}" method="post" enctype="multipart/form-data" id="image-upload"
        class="dropzone">
        @csrf

        <div>
            <h3>Ajout d'une ou de plusieurs pièces jointes</h3>
        </div>

    </form> --}}

    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 1,
            acceptedFiles: ".pdf,.jpeg,.png"
        };
    </script>
@endsection
