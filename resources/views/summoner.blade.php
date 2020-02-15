@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Summoner info</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="col">
                            <div class="row">
                                <strong><p>Id del summoner: </p></strong>
                                <p>{{$summoner['name']}}</p>
                            </div>
                            <div class="row">
                                <strong><p>Account id: </p></strong>
                                <p>{{$summoner['accountId']}}</p>
                            </div>
                            <div class="row">
                                <strong><p>Puuid: </p></strong>
                                <p>{{$summoner['puuid']}}</p>
                            </div>
                            <div class="row">
                                <strong><p>Nombre del summoner: </p></strong>
                                <p>{{$summoner['name']}}</p>
                            </div>
                            <div class="row">
                                <strong><p>ProfileIconId: </p></strong>
                                <p>{{$summoner['profileIconId']}}</p>
                            </div>
                            <div class="row">
                                <strong><p>Revision Date: </p></strong>
                                <p>{{$summoner['revisionDate']}}</p>
                            </div>
                            <div class="row">
                                <strong><p>Summoner level: </p></strong>
                                <p>{{$summoner['summonerLevel']}}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
