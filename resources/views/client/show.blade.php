@extends('Layouts.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show client</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('client.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div clas="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Raison social : </strong>
                {{-- {{ $Client->raisonSocial }} --}}
            </div>
        </div>
        <div clas="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name : </strong>
                {{-- {{ $Client->name }} --}}
            </div>
        </div>

@endsection
