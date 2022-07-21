@extends('layouts.app')

@section('content')
<div class="container">

    @include('inc.sidenavs')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" style="overflow-y:auto; height:35vh;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($requests->isEmpty())
                        <h3 class="text-center">No tienes nuevas solicitudes</h3>                      
                    @else
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-primary" scope="col">Nuevos Solicitudes</th>
                                    <th class="text-primary" scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $rqt)
                                    <tr>
                                        <td>
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{$rqt->com_name}} </h5>
                                                <small class="text-muted"><i class="fas fa-map-marker-alt"></i> {{$rqt->location}}</small>
                                                <small class="text-muted">Hace {{\Carbon\Carbon::now()->diffInDays($rqt->created_at)}} dias</small>
                                            </div>
                                            <p class="mb-1">Sociedad: {{$rqt->society}}</p>
                                            <p class="mb-1">Sector: {{$rqt->sector}}</p>
                                            <p class="mb-1">Propiedad: {{$rqt->property}}</p>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('company.show', $rqt->com_id)}}" class="btn btn-outline-info"><i class="far fa-eye"></i> Ver</a>
                                                <form action="{{ route('rejectRequest') }}" method="POST">
                                                    @csrf
                                                    <input type="text" value="{{$rqt->com_id}}" name="rejectCompany" id="rejectCompany" hidden>
                                                    <button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Rechazar</button>
                                                </form>
                                                <form action="{{ route('acceptRequest') }}" method="POST">
                                                    @csrf
                                                    <input type="text" value="{{$rqt->com_id}}" name="acceptCompany" id="acceptCompany" hidden>
                                                    <button class="btn btn-outline-success"><i class="fas fa-check"></i> Aceptar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <hr class="col-md-8">
        <div class="col-md-8">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <canvas id="Donut"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <canvas id="Donut1"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <canvas id="Polar"></canvas>    
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <canvas id="Radar"></canvas>     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection


@section('scripts')
  <script>
    new Chart(document.getElementById("Donut"), {
              type: 'doughnut',
              data: {
                labels: ["Sigo", "Seguidores"],
                datasets: [{
                  backgroundColor: ["#2b5797", "#b91d47"],
                  data: [3,4]
                }]
              },
              options: {
                title: {
                  display: true,
                  text: 'Perfil Profesional'
                }
              }
          });

    new Chart(document.getElementById("Donut1"), {
              type: 'doughnut',
              data: {
                labels: ["Sigue", "Seguidores"],
                datasets: [{
                  backgroundColor: ["#2b5797", "#b91d47"],
                  data: [10,7]
                }]
              },
              options: {
                title: {
                  display: true,
                  text: 'Perfil Empresa'
                }
              }
          });

    new Chart(document.getElementById("Polar"), {
              type: 'polarArea',
              data: {
                labels: [
                  'Positivo',
                  'Neutro',
                  'Negativo',
                ],
                datasets: [{
                  label: 'My First Dataset',
                  data: [67, 38, 29],
                  backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                  ]
                }]
              },
              options: {}
          });


    new Chart(document.getElementById("Radar"), {
              type: 'radar',
              data: {
                labels: ['Publicaciones','Me gusta','Compartidos','Busquedas'],
                datasets: [{
                  label: 'Datos',
                  data: [2, 4, 20, 13],
                  fill: true,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgb(255, 99, 132)',
                  pointBackgroundColor: 'rgb(255, 99, 132)',
                  pointBorderColor: '#fff',
                  pointHoverBackgroundColor: '#fff',
                  pointHoverBorderColor: 'rgb(255, 99, 132)'
                }]
              },
              options: {
                elements: {
                  line: {
                    borderWidth: 3
                  }
                }
              }
          });
  </script>
@endsection