@extends('Layouts.layout')

@section('content')
    <div class="container">
        <div class="row card text-white bg-dark">
            <h4 class="card-header">Contactez-moi</h4>
            <div class="card-body">
                <form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data" id="image-upload"
                    class="dropzone">
                    @csrf
                    {{-- @dd(Auth()); --}}
                    <select name="client" id="client" class="form-select">
                        {{-- @foreach ($clients as $client)
                            @foreach ($users as $user)
                                @if ($client->user_id == $user->id)
                                    <option value="{{ $client->id }}">{{ $client->slug }}</option>
                                @endif
                            @endforeach
                        @endforeach --}}
                    </select>
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
                    <input type="file" class="dropzone form-control @error('file') is-invalid @enderror" name="file"
                        id="file">
                    <button type="submit" class="btn btn-secondary">Envoyer !</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 1,
            acceptedFiles: ".pdf,.jpeg,.png"
        };
    </script>
@endsection
