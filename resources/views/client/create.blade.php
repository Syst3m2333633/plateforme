@extends('Layouts.layout')

@section('content')
    <div class="container">
        <div class="row card text-white bg-dark">
            <h4 class="card-header">Créer un utilisateur</h4>
            <a class="btn btn-primary" href="{{ route('client.index') }}">Retour</a>
            <div class="card-body">
                <div class="mb-3">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('client.store') }}" method="POST">
                        <!-- enctype="multipart/form-data" id="image-upload" -->
                        @csrf
                        <input type="text" class="form-control  @error('raisonSocial') is-invalid @enderror"
                            name="raisonSocial" id="raisonSocial" placeholder="raisonSocial" value="{{-- {{ old('raisonSocial') }} --}}">
                        @error('raisonSocial')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control  @error('adresse') is-invalid @enderror" name="adresse"
                        id="adresse" placeholder="adresse" value="{{-- {{ old('adresse') }} --}}">
                    @error('adresse')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control  @error('complAdresse') is-invalid @enderror"
                        name="complAdresse" id="complAdresse" placeholder="complAdresse" value="{{-- {{ old('complAdresse') }} --}}">
                    @error('complAdresse')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control  @error('codePostal') is-invalid @enderror" name="codePostal"
                        id="codePostal" placeholder="35430" value="{{-- {{ old('codePostal') }} --}}">
                    @error('codePostal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control  @error('ville') is-invalid @enderror" name="ville"
                        id="ville" placeholder="ville" value="{{-- {{ old('ville') }} --}}">
                    @error('ville')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control  @error('pays') is-invalid @enderror" name="pays"
                        id="pays" placeholder="pays" value="{{-- {{ old('pays') }} --}}">
                    @error('pays')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control  @error('telephone') is-invalid @enderror" name="telephone"
                        id="telephone" placeholder="telephone" value="{{-- {{ old('telephone') }} --}}">
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                        id="name" placeholder="name" value="{{-- {{ old('name') }} --}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control  @error('firstname') is-invalid @enderror" name="firstname"
                        id="firstname" placeholder="firstname" value="{{-- {{ old('firstname') }} --}}">
                    @error('firstname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                        id="email" placeholder="email" value="{{-- {{ old('email') }} --}}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="password" value="{{-- {{ old('password') }} --}}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- @method('POST') --}}
                {{-- <input  type="file" class="dropzone form-control @error('file') is-invalid @enderror" name="file" id="file" value="https://www.fichier-pdf.fr/telecharger/?hash=mZ8rz8i9Ov1ygjZrHU56b4WH2SDrQ3zo7OF1J2z0KS25cMPsupKI0zFVO9Y2CmG8GR674BJ2P5W9D4wz7f1s4iNXRV020xttor10g11ZCz422Du9FXXqW3Y26TQq2Y07">{{ old( 'file') }} --}}
            </div>
            <button type="submit" class="btn btn-primary">Envoyer !</button>
            </form>
        </div>
    </div>
@endsection
