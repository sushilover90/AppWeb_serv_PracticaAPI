@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="into">
                    <div class="card-header; text-center" id="header">Tu riot token actual, si ya caducó, ingresa uno nuevo.</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="app">
                            <riot-token datos="{{$datos}}">

                            </riot-token>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a class="btn btn-outline-info" href="/home" id="fond">Volver a inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
