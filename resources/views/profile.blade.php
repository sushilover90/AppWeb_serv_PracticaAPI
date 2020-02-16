@extends('layouts.app')

@section('content')
    <div class="px-5">
        <profile-component get_icon="{{ $icon }}" get_favchampions="{{ $fav }}"/>
    </div>
@endsection
