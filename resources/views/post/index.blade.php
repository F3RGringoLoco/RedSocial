@extends('layouts.app')

@section('content')
<div class="container">

    @include('inc.sidenavs')

    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-light">
                    <div class="card-header">
                        @if (Auth::check())
                            <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Nueva Publicación
                            </button>
                        @endif
                        <h3 class="pe-none">Publicaciones</h3>
                    </div>
                        <div class="card-body" style="overflow-y:auto; height:82vh;">
                            @if (count($posts) > 0)
                                @foreach ($posts as $pts)
                                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                        <div class="card-header">
                                            <small class="float-right pe-none">{{date_format(new DateTime($pts->created_at), 'F d Y - h:m a')}}</small>
                                            <a href="{{route('company.show', $pts->com_id)}}" class="text-dark" style="text-decoration: none;">
                                                <img src="{{$pts->com_image != null ? Storage::disk('s3')->url('companies_pics/'.$pts->com_image) : asset('storage/user_img.png')}}" class="img-fluid rounded-circle float-left" alt="" width="50" height="50">
                                                <span style="font-size: 25px; font-weight: bold;">{{$pts->com_name}}</span>
                                            </a>
                                            <p style="padding: 0; margin: 0;"><small>Publicado por <a class="custom-link" href="{{route('profesional.show', $pts->id)}}">{{$pts->name}}</a></small></p>
                                        </div>
                                        <div class="card-body">
                                            <p>{{$pts->description}}</p>
                                            @if ($pts->image != null)
                                                <img src="{{Storage::disk('s3')->url('posts_pics/'.$pts->image)}}" class="img-fluid" alt="" width="100%" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                                <div class="float-left">
                                                    @if (Auth::check())
                                                        <h6 id="btnLike{{$pts->post_id}}" style="text-align: center;display: inline-block;cursor: pointer; color:{{$pts->liked ? '#202A44' : '#7B7B7C' }}" onclick="likePost({{$pts->post_id}})">Me gusta <i class="fa fa-solid fa-thumbs-up"></i></h6>
                                                        <span class="pe-none">  |  </span>    
                                                    @endif
                                                    <span class="custom1-link" onclick="sharePost({{$pts->post_id}})">Compartir <i class="fa fa-solid fa-share-alt"></i></span>
                                                </div>
                                                <div class="float-right">
                                                    <span class="pe-none text-secondary">Me gusta <span id="likes{{$pts->post_id}}">{{$pts->likeCount}}</span></span>
                                                    <small class="pe-none text-secondary"> | </small>  
                                                    <span class="pe-none text-secondary">Compartidos <span id="shares{{$pts->post_id}}">{{$pts->shares}}</span></span>
                                                </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                                <p class="pe-none text-center text-primary">Fin de Publicaciones</p>
                            @else
                                <h3 class="text-center">No hay publicaciones para mostrar</h3>
                            @endif
                    </div>
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
                        <input class="form-control" value="{{ old('image') }}" type="file" id="image" name="image" accept="image/*">
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

@include('inc.likeable')
