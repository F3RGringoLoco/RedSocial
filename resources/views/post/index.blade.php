@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="justify-content-around">
        <div class="row ">
            <div class="col">
                <div class="card" style="overflow-y: auto;">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active disabled" aria-current="true">
                            Menú
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A fifth link item</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if (Auth::check())
                            <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Nueva Publicación
                            </button>
                        @endif
                        <h3>Publicaciones</h3>
                    </div>
                        <div class="card-body" style="overflow-y:auto; height:80vh;">
                            @if (count($posts) > 0)
                                @foreach ($posts as $pts)
                                    <div class="card">
                                        <div class="card-header">
                                            <small class="float-right">{{date_format(new DateTime($pts->created_at), 'F d Y - h:m a')}}</small>
                                            <a href="{{route('profesional.show', $pts->id)}}" class="text-dark" style="text-decoration: none;">
                                                <img src="https://d2qp0siotla746.cloudfront.net/img/use-cases/profile-picture/template_0.jpg" class="img-fluid rounded-circle float-left" alt="" width="50" height="50">
                                                <span style="font-size: 25px; font-weight: bold;">{{$pts->name}}</span>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p>{{$pts->description}}</p>
                                            @if ($pts->image == '')
                                                <img src="https://www.salleurl.edu/sites/default/files/content/nodes/View%20Page/image/4250/39448/business_and_management_la_salle_campus_barcelona.jpg" class="img-fluid" alt="" width="100%" height="300">
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            
                                                <div class="float-left">
                                                    @if (Auth::check())
                                                        <a href="#" class="text-secondary" style="text-decoration: none;">Me gusta <i class="fa fa-solid fa-thumbs-up"></i></a>
                                                        <span>  |  </span>    
                                                        <a href="#" class="text-secondary" style="text-decoration: none;">Comentar <i class="fa fa-solid fa-comment"></i></a>
                                                        <span>  |  </span>    
                                                    @endif
                                                    <a href="#" class="text-secondary" style="text-decoration: none;">Compartir <i class="fa fa-solid fa-share-alt"></i></a>
                                                </div>
                                                <div class="float-right">
                                                    <small class="text-secondary">Me gusta {{$pts->likes}}  |  Compartidos {{$pts->shares}}  |  Comentarios {{$pts->comments}}</small>
                                                </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                                <p class="text-center text-primary">Fin de Publicaciones</p>
                            @else
                                <h3 class="text-center">No hay publicaciones para mostrar</h3>
                            @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Contactos
                    </div>
                    <ol class="list-group list-group-numbered" style="overflow-y: auto;">
                        <li class="list-group-item">A list item</li>
                        <li class="list-group-item">A list item</li>
                        <li class="list-group-item">A list item</li>
                    </ol>
                </div>
            </div>
          </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Publicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="description">{{ __('Descripción') }}</label>
                        <textarea id="description" type="textarea" class="form-control" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus placeholder="Que estas pensando...."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">{{ __('Imagen') }}</label>
                        <input class="form-control" value="{{ old('image') }}" type="file" id="image" name="image" accept="image/*" required>

                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Publicar</button>
                    </div>
                </form>
            </div>
      </div>
    </div>
  </div>


@endsection
