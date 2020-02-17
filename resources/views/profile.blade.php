@extends('layouts.app')

@section('content')
    <div class="px-5">
        <profile-component get_user="{{ $user }}"
            get_icon="{{ $icon }}"
                get_favchampions="{{ $fav }}"
                    get_ranked="{{ $ranked }}"
                        get_match="{{ $matchs }}"/>
    </div>
@endsection
