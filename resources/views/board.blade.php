@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Board</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/summoner" method="post">
                            @csrf
                            <label for="summoner_name">Nombre del summoner</label>
                            <input id="summoner_name" class="form-control mb-2" type="text" name="summoner_name">
                            <input class="btn btn-outline-info" type="submit" value="Buscar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
