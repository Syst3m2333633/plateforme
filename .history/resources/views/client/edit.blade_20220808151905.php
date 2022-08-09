@extends('Layouts.layout')

@section('content')
    <div class="container">
        <div class="row card text-white bg-dark">
            {{-- <h4 class="card-header">Edit Client</h4>{{$client->avatar}} --}}
            {{-- @dd($client->slug) --}}
            <img class="img-fluid" style="height:40vh" src="{{--{{ route('client.image', ['client' => $client->slug]) }}--}}../app/add-code/logo/AddCodelogo.png" alt="avatar">
            {{-- <img src="{{route('storage/' . $client->raisonSocial . '/logo/' . $client->avatar) }}" alt="avatar"> --}}
            <a class="btn btn-primary" href="{{ route('client.index') }}">Retour</a>


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

                <form action="{{ route('client.update', ['client' => $client]) }}" method="POST">
                    @csrf
                    @method('PUT')

                <div class="row">
                    <div class="card my-10 bg-dark">
                        {{-- <div class="form-group">
                            <strong>Id:</strong>
                            <input type="text" name="identity" value="{{ $client->id }}" class="form-control"
                                placeholder="identity">
                        </div> --}}
                        <div class="form-group">
                            <strong>Raison social:</strong>
                            {{-- <input type="text" name="raisonSocial" value="{{ $client->raisonSocial }}"
                                class="form-control" placeholder="raisonSocial"> --}}
                            {{-- <input type="text" name="raisonSocial" value="{{old('raisonSocial') ?? $client->raisonSocial }}"
                                class="form-control" placeholder="raisonSocial"> --}}
                            <input type="text" name="raisonSocial" value="{{Request::old('raisonSocial') ?? $client->raisonSocial }}"
                                class="form-control" placeholder="raisonSocial">
                        </div>
                        {{-- <div class="form-group">
                            <strong>Slug:</strong>
                            <input type="text" name="slug" value="{{ $client->slug }}" class="form-control"
                                placeholder="slug">
                        </div> --}}
                        <div class="form-group">
                            <strong>Adresse:</strong>
                            <input type="text" name="adresse" value="{{ $client->adresse }}" class="form-control"
                                placeholder="adresse">
                        </div>
                        <div class="form-group">
                            <strong>Complement d'adresse:</strong>
                            <input type="text" name="complAdresse" value="{{ $client->complAdresse }}"
                                class="form-control" placeholder="complement d'adresse">
                        </div>
                        <div class="form-group">
                            <strong>Code postal:</strong>
                            <input type="text" name="codePostal" value="{{ $client->codePostal }}" class="form-control"
                                placeholder="codePostal">
                        </div>
                        <div class="form-group">
                            <strong>Ville:</strong>
                            <input type="text" name="ville" value="{{ $client->ville }}" class="form-control"
                                placeholder="ville">
                        </div>
                        <div class="form-group">
                            <strong>Pays:</strong>
                            <input type="text" name="pays" value="{{ $client->pays }}" class="form-control"
                                placeholder="pays">
                        </div>
                        <div class="form-group">
                            <strong>Téléphone:</strong>
                            <input type="text" name="telephone" value="{{ $client->telephone }}" class="form-control"
                                placeholder="telephone">
                        </div>
                        <div class="form-group">
                            <strong>Nom:</strong>
                            <input type="text" name="name" value="{{ $client->name }}" class="form-control"
                                placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <strong>Prénom:</strong>
                            <input type="text" name="firstname" value="{{ $client->firstname }}" class="form-control"
                                placeholder="Prénom">
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" value="{{ $client->email }}" class="form-control"
                                placeholder="email">
                        </div>
                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right" >{{ __('Avatar (optional)') }} {{$client->avatar}}</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control" name="avatar" value="{{$client->avatar}}">
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <strong>Password:</strong>
                            <input type="text" name="password" value="{{ ($client->password) }}" class="form-control"
                                placeholder="password">
                        </div> --}}
                    </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    {{-- <a class="btn btn-success" href="{{ route('client.update', ['client' => $client]) }}">Update Client</a> --}}
                </form>
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    </div> --}}
                </div>

            {{-- </form> --}}
        </div>
    </div>
@endsection
