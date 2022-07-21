@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-group">
                <div class="card">
                    <img src="https://thumbs.dreamstime.com/b/hombre-de-negocios-sobre-fondo-negro-negocio-y-concepto-de-la-oficina-91767339.jpg" class="card-img" alt="...">
                    <!--<img src="{{asset('storage/register_img.jpeg')}}" class="card-img" alt="...">-->
                    <div class="card-img-overlay">
                        <h3 class="card-title text-white text-center">Bienvenido</h3>
                    </div>
                </div>

                <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="card-header">{{ __('Registro') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Completo') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="birth" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Nacimiento') }}</label>
    
                                <div class="col-md-6">
                                    <input id="birth" type="date" class="form-control @error('birth') is-invalid @enderror" name="birth" value="{{ old('birth') }}" required>
    
                                    @error('birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>
    
                                <div class="col-md-6">
                                    <input id="phone" type="number" max="99999999" min="10000000" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
    
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="career" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione su Profesión') }}</label>
    
                                <div class="col-md-6">
                                    <select class="form-select form-control" id="career" name="career" required>
                                        <option value="INGENIERIA INFORMATICA">INGENIERIA INFORMATICA</option>
                                        <option value="INGENIERIA COMERCIAL">INGENIERIA COMERCIAL</option>
                                        <option value="LEYES">LEYES</option>
                                        <option value="PSICOLOGIA">PSICOLOGIA</option>
                                        <option value="MECANICA">MECANICA</option>
                                        <option value="ELECTRONICA">ELECTRONICA</option>
                                        <option value="MEDICO">MEDICO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="image">{{ __('Imagen') }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" value="{{ old('image') }}" type="file" id="image" name="image" accept="image/*" required>
                                    </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="vstack gap-2 col-md-8 mx-auto">
                                <span class="text-center">Ya tienes una Cuenta?  <a href="{{route('login')}}">Iniciar Sesión</a></span>
                            </div> 
                            <br>
                            <div class="form-group row mb-0">
                                <div class="d-grid gap-2 col-4 mx-auto">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrarme') }}
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
