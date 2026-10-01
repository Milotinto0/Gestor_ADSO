@extends('layouts.app')
@section('title','Mi Perfil')

@section('content')
<div class="contenedor">
    <h1>Mi Perfil</h1>

    <div class="perfil-grid">
        <div class="perfil-card">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="perfil-card">
            @include('profile.partials.update-password-form')
        </div>

        <div class="perfil-card perfil-peligro">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection