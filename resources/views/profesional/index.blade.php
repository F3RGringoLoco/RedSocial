@extends('layouts.app')

@section('content')
<div class="container">

    @include('inc.sidenavs')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-light">
                <div class="card-header">
                    <h3>Profesionales</h3>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Perfil</th>
                                <!--<th>Nombre</th>
                                <th>Edad</th>
                                <th>Profesión</th>
                                <th scope="col" width="30px"></th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profesionals as $prof)
                                <tr>
                                    <td>
                                        <div class="card">
                                            <div class="card-body">
                                                <!--<img src="https://browsee.io/blog/content/images/2018/06/da831ab8-705e-4f35-a504-4dbe0767e67e-medium.png" class="img-fluid rounded-circle float-left" alt="" width="100" height="100">-->
                                                <img class="img-fluid rounded-circle float-left" src="{{$prof->image != null ? Storage::disk('s3')->url('profesionals_pics/'.$prof->image) : asset('storage/user_img.png')}}" alt="" width="100" height="100">
                                                <h5 class="float-right">Edad: {{\Carbon\Carbon::now()->diffInYears($prof->birth)}}</h5>
                                                <h3>{{$prof->name}}</h3>
                                                <small>Profesión: {{$prof->career}}</small>
                                                <a href="{{route('profesional.show', $prof->id)}}" class="btn hidden float-right stretched-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"></a>
                                            </div>
                                        </div>
                                    </td>
                                    <!--<td>
                                        <img src="https://browsee.io/blog/content/images/2018/06/da831ab8-705e-4f35-a504-4dbe0767e67e-medium.png" class="img-fluid rounded-circle float-left" alt="" width="100" height="100">
                                    </td>
                                    <td>{{$prof->name}}</td>
                                    <td>{{\Carbon\Carbon::now()->diffInYears($prof->birth)}}</td>
                                    <td>{{$prof->career}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <a href="{{route('profesional.show', $prof->id)}}" class="btn btn-outline-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"><i class="far fa-eye"></i></a>
                                            <a href="#" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                        </div> 
                                    </td>-->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('inc.datatable')