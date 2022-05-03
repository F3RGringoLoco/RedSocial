@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <img class="card-img-top img-fluid rounded-circle" width="100" height="100" src="https://browsee.io/blog/content/images/2018/06/da831ab8-705e-4f35-a504-4dbe0767e67e-medium.png" alt="Card image">
                <div class="card-body">
                    <h3 class="card-title">{{$profesional->name}}</h3>
                    <h5 class="float-right">Edad: {{\Carbon\Carbon::now()->diffInYears($profesional->birth)}}</h5>
                    <p>
                        <small class="text-danger">Profesión: </small>{{$profesional->career}}
                    </p>
                    <p>
                        <small class="text-danger">Teléfono: </small>{{$profesional->phone}}
                    </p>
                    <p>
                        <small class="text-danger">Correo Electrónico: </small>{{$email[0]}}
                    </p>
                  <a href="{{route('profesional.index')}}" class="btn btn-outline-secondary float-right" data-bs-toggle="tooltip" data-bs-placement="top" title="Volver">Volver</a>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection