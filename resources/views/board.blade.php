@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card" id="into">
                    <div class="card-header" align="center">Información del usuario</div>

                    <div class="card-body" id="into">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert" id="fond">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="app">
                            <summoner-info>

                            </summoner-info>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
