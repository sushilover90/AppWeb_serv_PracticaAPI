@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <a class="btn btn-outline-info mb-3" href="/board">Board</a>

                        @if(Auth::user()->api_token==null)
                            <form action="/crear/token" method="post">
                                <button class="btn btn-outline-info" type="submit">Crear token</button>
                        @else
                            <form action="/borrar/token" method="post">
                                <button class="btn btn-outline-info" type="submit">Borrar token</button>
                        @endif
                        @csrf
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
