@extends('layouts.app')

@section('content')
    <div class="container">

        @include('inc.sidenavs')

        <div class="row justify-content-center">   
            <div class="col-md-6">
                <div class="card border-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="card-header">
                        Registro Negocio
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="pro_name">{{ __('Nombre del Negocio') }}</label>
                                <input id="pro_name" type="text" class="form-control" name="pro_name" value="{{ old('pro_name') }}" required autocomplete="com_name" autofocus placeholder="Negocio">                           
                            </div>

                            <div class="row g-3">
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
                                <div class="col-6">
                                    <label for="image">{{ __('Imagen') }}</label>
                                    <input class="form-control" value="{{ old('image') }}" type="file" id="image" name="image" accept="image/*" required>
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="description">{{ __('Descripción ') }}</label><small class="text-muted">  (Pequeña descripción del negocio) Max. 255 caracteres</small>
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus placeholder="Empresa"> </textarea>                          
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