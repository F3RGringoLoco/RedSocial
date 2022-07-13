@extends('layouts.app')

@section('content')
    <div class="container">

        @include('inc.sidenavs')

        <div class="row justify-content-center">   
            <div class="col-md-6">
                <div class="card border-light" style="box-shadow: 0 4px 8px 0 #00000033, 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="card-header">
                        Editar perfil de empresa
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('company.update', $company->com_id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="com_name">{{ __('Nombre de la empresa') }}</label>
                                <input id="com_name" type="text" class="form-control" name="com_name" value="{{$company->com_name}}" required autocomplete="com_name" autofocus placeholder="Empresa">                           
                            </div>

                            
                            <div class="row g-2">
                                <div class="col-6">
                                    <label for="society">{{ __('Seleccione su Sociedad') }}</label>
        
                                    <select class="form-select form-control" id="society" name="society" required>
                                        <option value="S.R.L. (Sociedad de Responsabilidad Limitada)" {{$company->society == "S.R.L. (Sociedad de Responsabilidad Limitada)" ? 'selected' : ''}}>S.R.L. (Sociedad de Responsabilidad Limitada)</option>
                                        <option value="S.A. (Sociedad Anónima)" {{$company->society == "S.A. (Sociedad Anónima)" ? 'selected' : ''}}>S.A. (Sociedad Anónima)</option>
                                        <option value="S.C. (Sociedad Colectiva)" {{$company->society == "S.C. (Sociedad Colectiva)" ? 'selected' : ''}}>S.C. (Sociedad Colectiva)</option>
                                        <option value="S.C.S. (Sociedad en Comandita Simple)" {{$company->society == "S.C.S. (Sociedad en Comandita Simple)" ? 'selected' : ''}}>S.C.S. (Sociedad en Comandita Simple)</option>
                                        <option value="A.A. (Asociación Accidental)" {{$company->society == "A.A. (Asociación Accidental)" ? 'selected' : ''}}>A.A. (Asociación Accidental)</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="sector">{{ __('Seleccione su Sector Económico') }}</label>
    
                                    <select class="form-select form-control" id="sector" name="sector" required>
                                        <option value="Sector Primario" {{$company->sector == "Sector Primario" ? 'selected' : ''}}>Sector Primario (Agricultura, ganadería, pesca y minería)</option>
                                        <option value="Sector Secundario" {{$company->sector == "Sector Secundario" ? 'selected' : ''}}>Sector Secundario (Empresas dedicadas a la industria y la construcción)</option>
                                        <option value="Sector Terciario" {{$company->sector == "Sector Terciario" ? 'selected' : ''}}>Sector Terciario (Sector servicios)</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="property">{{ __('Seleccione su Propiedad') }}</label>
    
                                    <select class="form-select form-control" id="property" name="property" required>
                                        <option value="Privada" {{$company->property == "Privada" ? 'selected' : ''}}>Privada</option>
                                        <option value="Pública" {{$company->property == "Pública" ? 'selected' : ''}}>Pública</option>
                                        <option value="Privada y Pública" {{$company->property == "Privada y Pública" ? 'selected' : ''}}>Privada y Pública</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="location">{{ __('Seleccione su Ubicación') }}</label>
    
                                    <select class="form-select form-control" id="location" name="location" required>
                                        <option value="Santa Cruz de la Sierra, Bolivia" {{$company->location == "Santa Cruz de la Sierra, Bolivia" ? 'selected' : ''}}>Santa Cruz de la Sierra, Bolivia</option>
                                        <option value="La Paz, Bolivia" {{$company->location == "La Paz, Bolivia" ? 'selected' : ''}}>La Paz, Bolivia</option>
                                        <option value="Cochabamba, Bolivia" {{$company->location == "Cochabamba, Bolivia" ? 'selected' : ''}}>Cochabamba, Bolivia</option>
                                        <option value="Oruro, Bolivia" {{$company->location == "Oruro, Bolivia" ? 'selected' : ''}}>Oruro, Bolivia</option>
                                        <option value="Potosí, Bolivia" {{$company->location == "Potosí, Bolivia" ? 'selected' : ''}}>Potosí, Bolivia</option>
                                        <option value="Chuquisaca, Bolivia" {{$company->location == "Chuquisaca, Bolivia" ? 'selected' : ''}}>Chuquisaca, Bolivia</option>
                                        <option value="Beni, Bolivia" {{$company->location == "Beni, Bolivia" ? 'selected' : ''}}>Beni, Bolivia</option>
                                        <option value="Pando, Bolivia" {{$company->location == "Pando, Bolivia" ? 'selected' : ''}}>Pando, Bolivia</option>
                                        <option value="Tarija, Bolivia" {{$company->location == "Tarija, Bolivia" ? 'selected' : ''}}>Tarija, Bolivia</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="description">{{ __('Descripción ') }}</label><small class="text-muted">  (Pequeña descripción de la empresa) Max. 255 caracteres</small>
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus placeholder="Empresa">{{$company->description}}</textarea>                          
                            </div>
                            
                            <div class="row g-2">
                                <div class="col-6">
                                    <label for="image">{{ __('Imagen') }}</label>
                                    <input class="form-control" value="{{ old('image') }}" type="file" id="image" name="image" accept="image/*">
                                </div>

                                <div class="col-6">
                                    <label for="cover">{{ __('Cover') }}</label>
                                    <input class="form-control" value="{{ old('cover') }}" type="file" id="cover" name="cover" accept="image/*">
                                </div>

                                <div class="col-6">
                                    
                                </div>

                                <div class="col-6">

                                </div>
                            </div>

                            <br>

                            <div class="float-right">
                                <a class="btn btn-outline-secondary" href="{{route('company.index')}}">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection