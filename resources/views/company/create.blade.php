@extends('layouts.app')

@section('content')
    <div class="container">

        @include('inc.sidenavs')

        <div class="row justify-content-center">   
            <div class="col-md-6">
                <div class="card border-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="card-header">
                        Registro perfil de empresa
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('company.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="com_name">{{ __('Nombre de la empresa') }}</label>
                                <input id="com_name" type="text" class="form-control" name="com_name" value="{{ old('com_name') }}" required autocomplete="com_name" autofocus placeholder="Empresa">                           
                            </div>

                            
                            <div class="row g-3">
                                <div class="col-6">
                                    <label for="society">{{ __('Seleccione su Sociedad') }}</label>
        
                                    <select class="form-select form-control" id="society" name="society" required>
                                        <option value="S.R.L. (Sociedad de Responsabilidad Limitada)">S.R.L. (Sociedad de Responsabilidad Limitada)</option>
                                        <option value="S.A. (Sociedad Anónima)">S.A. (Sociedad Anónima)</option>
                                        <option value="S.C. (Sociedad Colectiva)">S.C. (Sociedad Colectiva)</option>
                                        <option value="S.C.S. (Sociedad en Comandita Simple)">S.C.S. (Sociedad en Comandita Simple)</option>
                                        <option value="A.A. (Asociación Accidental)">A.A. (Asociación Accidental)</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="sector">{{ __('Seleccione su Sector Económico') }}</label>
    
                                    <select class="form-select form-control" id="sector" name="sector" required>
                                        <option value="Sector Primario">Sector Primario (Agricultura, ganadería, pesca y minería)</option>
                                        <option value="Sector Secundario">Sector Secundario (Empresas dedicadas a la industria y la construcción)</option>
                                        <option value="Sector Terciario">Sector Terciario (Sector servicios)</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label for="property">{{ __('Seleccione su Propiedad') }}</label>
    
                                    <select class="form-select form-control" id="property" name="property" required>
                                        <option value="Privada">Privada</option>
                                        <option value="Pública">Pública</option>
                                        <option value="Privada y Pública">Privada y Pública</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="location">{{ __('Seleccione su Ubicación') }}</label>
    
                                    <select class="form-select form-control" id="location" name="location" required>
                                        <option value="Santa Cruz de la Sierra, Bolivia">Santa Cruz de la Sierra, Bolivia</option>
                                        <option value="La Paz, Bolivia">La Paz, Bolivia</option>
                                        <option value="Cochabamba, Bolivia">Cochabamba, Bolivia</option>
                                        <option value="Oruro, Bolivia">Oruro, Bolivia</option>
                                        <option value="Potosí, Bolivia">Potosí, Bolivia</option>
                                        <option value="Chuquisaca, Bolivia">Chuquisaca, Bolivia</option>
                                        <option value="Beni, Bolivia">Beni, Bolivia</option>
                                        <option value="Pando, Bolivia">Pando, Bolivia</option>
                                        <option value="Tarija, Bolivia">Tarija, Bolivia</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="description">{{ __('Descripción ') }}</label><small class="text-muted">  (Pequeña descripción de la empresa) Max. 255 caracteres</small>
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus placeholder="Empresa"> </textarea>                          
                            </div>
                            <div class="form-group">
                                <label for="image">{{ __('Imagen') }}</label>
                                <input class="form-control" value="{{ old('image') }}" type="file" id="image" name="image" accept="image/*" required>
                            </div>

                            <div class="float-right">
                                <a class="btn btn-outline-secondary" href="{{route('company.index')}}">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection