@extends('Layouts.layout')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-2 mb-2">Facture</h1>

                <select name="client" id="client">
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
                </select>

                <form action="{{ route('dropzone.store'{{--, ['id' => $users->id]--}}) }}" method="post"
                    enctype="multipart/form-data" id="image-upload" class="dropzone">
                    @csrf

                    <div>
                        <h3>Ajout de plusieurs devis en cliquant ou en déposant sur la fenêtre</h3>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-2 mb-2">Factures</h1>

                <form action="{{ route('dropfactures.store') }}" method="post" enctype="multipart/form-data"
                    id="image-upload" class="dropzone">
                    @csrf
                    <div>
                        <h3>Ajout de plusieurs factures en cliquant ou en déposant sur la fenêtre</h3>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 1,
            acceptedFiles: ".pdf"
        };
    </script>
@endsection





















{{-- <head>
  <title>Laravel 9 File Upload Example - Tutsmake.com</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<body> --}}
{{-- <div class="container mt-4">

  <h2 class="text-center">File Upload in Laravel 9 - Tutsmake.com</h2>

      <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('devis.store') }}" >

          <div class="row">

              <div class="col-md-12">
                  <div class="form-group">
                      <input type="file" name="file" placeholder="Choose file" id="file">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                  </div>
              </div>

              <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" id="submit">Submit</button>
              </div>
          </div>
      </form>
</div>

</div>
</body>
</html> --}}
