@extends('Layouts.layout')
@section('content')

<div class="container">
    <div class="row card text-white bg-dark">
        <h4 class="card-header">Déposer un devis</h4>
        <div class="card-body">
            <form action="{{ route('devis.store') }}" method="post" enctype="multipart/form-data"
            id="image-upload" class="dropzone">
            @csrf
            <select name="client" id="client" class="form-select">
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->slug }}</option>
                @endforeach
                </select>
                <input type="file" class="dropzone form-control @error('file') is-invalid @enderror" name="file" id="file">
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
