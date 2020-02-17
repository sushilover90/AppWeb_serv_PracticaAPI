@extends('layouts.app')

@section('content')

    <div class="container" align="center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="into">
                    <div class="card-header" id="into">Tu token, lo necesitas para usar nuestra API.</div>

                    <div class="card-body" id="into">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{$token}}
                    </div>
                    <div class="card-footer" id="into">
                        <a id="fond" class="btn btn-outline-info" href="/home">Volver a inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
