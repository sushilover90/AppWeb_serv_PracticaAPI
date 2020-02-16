@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tu token, lo necesitas para usar nuestra API.</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{$token}}
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-outline-info" href="/home">Volver a inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
