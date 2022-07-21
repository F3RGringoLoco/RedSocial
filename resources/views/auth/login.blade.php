@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card">
                    <img src="https://us.123rf.com/450wm/hasloo/hasloo1407/hasloo140701165/29711370-hombre-de-negocios-con-exceso-de-trabajo-burnout-sin-cabeza-de-pie-con-bombilla-explot%C3%B3-en-lugar-de-.jpg?ver=6" class="card-img" alt="...">
                    <!--<img src="{{asset('storage/login_img.jpeg')}}" class="card-img" alt="...">-->
                    <div class="card-img-overlay">
                        <h3 class="card-title text-white text-center">Bienvenido</h3>
                    </div>
                </div>
                <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="card-header">
                        {{ __('Iniciar Sesión') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="vstack gap-2 col-md-12 mx-auto">
                                <span class="text-center">No tienes una Cuenta?  <a href="{{route('register')}}">Registrarme</a></span>
                            </div>  
                            <br>
                            <div class="form-group row mb-0">
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Iniciar Sesión') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
