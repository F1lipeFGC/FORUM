@extends('layouts.header')

@section('content')


<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="ContLog">

    <img class="NavbarCad" src="{{ asset('images/Ofclogo.png') }}">
        <div class="login-container">
            <form action="{{ route('login')}}" method="POST" class="login-form">
                <h2 class="login-title">Faça Seu Login</h2>
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                    @error('email') <span class="error-message">{{$message}}</span> @enderror
                </div>
            
                <div class="form-group">
                    <label for="password" class="form-label">Senha:</label>
                    <input type="password" id="password" name="password" class="form-input">
                    @error('password') <span class="error-message">{{$message}}</span> @enderror
                </div>
            
                <input type="submit" class="submit-button" value="Enviar">
            </form>
        </div>
</div>
@endsection
