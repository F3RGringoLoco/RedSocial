@extends('layouts.app')

@section('content')
    <div class="container">

        @include('inc.sidenavs')

        <div class="row justify-content-center">   
            <div class="col-md-6">
                <div class="card border-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="card-header">
                        Registro de miembros de la empresa
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('member.store')}}">
                            @csrf
                            
                                <label for="myInput">{{ __('Seleccione Profesional') }}</label>
                                <input class="form-control" type="text" id="myText" onkeyup="Filter()" placeholder="Busque por nombres..">
                                <select class="form-select" id="mySelect" size="3" name="user_id" required>
                                    @foreach ($profesionals as $prof)
                                        <option value="{{$prof->id}}">{{$prof->name}}  -   {{$prof->career}}</option>
                                    @endforeach
                                </select>
                            <br>

                            <div class="form-group">
                                <label for="field">{{ __('Campo de trabajo') }}</label>
                                <input id="field" type="text" class="form-control" name="field" value="{{ old('field') }}" required autocomplete="field" autofocus placeholder="Campo...">                           
                            </div>

                            <div class="form-group">
                                <label for="position">{{ __('Posición de trabajo') }}</label>
                                <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" required autocomplete="position" autofocus placeholder="Posición...">                           
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

@include('inc.filter')