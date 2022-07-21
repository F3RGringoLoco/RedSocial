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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profesionals as $prof)
                                <tr>
                                    <td>
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid rounded-circle float-left" src="{{$prof->image != null ? Storage::disk('s3')->url('profesionals_pics/'.$prof->image) : 'https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png'}}" alt="" width="100" height="100">
                                                <h5 class="float-right">Edad: {{\Carbon\Carbon::now()->diffInYears($prof->birth)}}</h5>
                                                <h3>{{$prof->name}}</h3>
                                                <small>Profesión: {{$prof->career}}</small>
                                                <a href="{{route('profesional.show', $prof->id)}}" class="btn hidden float-right stretched-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"></a>
                                            </div>
                                        </div>
                                    </td>
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