@extends('layouts.app')

@section('content')
<div class="container">

    @include('inc.sidenavs')

    <div class="row justify-content-center">   
        
<!-- Perfil publico -->
        <div class="col-md-8 mx-auto"> <!-- Profile widget --> 
            <div class="bg-white shadow rounded overflow-hidden"> 
                <div class="px-4 pt-0 pb-4 cover" style="background-image: url({{$company->bg_image != null ?  Storage::disk('s3')->url('companies_bg/'.$company->bg_image) : asset('storage/cover_img1.jpeg')}});"> 
                    <div class="media align-items-end profile-head"> 
                        <div class="profile mr-3">
                            <img src="{{$company->com_image != null ? Storage::disk('s3')->url('companies_pics/'.$company->com_image) : asset('storage/user_img.png')}}" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                            <div class="profile">
                                <h6 id="followBtn" class="mx-3" style="text-align: center;display: inline-block;cursor: pointer; color:{{$company->followed ? '#761F17' : '#202A44' }}" onclick="followProfile({{$company->com_id}})">Me gusta <i class="fas fa-heart"></i></h6>
                                <h6 style="text-align: center;display: inline-block;cursor: pointer; color:#202A44" onclick="sendRequest({{$company->com_id}})">Añadir contacto <i class="fas fa-handshake"></i></h6> 
                            </div>
                        </div> 
                        <div class="media-body mb-5 text-white"> 
                            <h4 class="fw-bolder mt-0 mb-0">{{$company->com_name}}</h4>
                            <p class="fw-bold small mb-4">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{$company->location}}
                            </p> 
                        </div> 
                    </div> 
                </div> 
                <div class="bg-light p-4 d-flex justify-content-end text-center"> 
                    <ul class="list-inline mb-0"> 
                        <li class="list-inline-item"> 
                            <a class="custom1-link" data-bs-toggle="modal" data-bs-target="#imageModal" href="">
                                <h5 class="font-weight-bold mb-0 d-block">
                                    @if ($posts == null)
                                        0
                                    @else
                                        {{$posts->where('image', '<>', null)->count()}}
                                    @endif
                                </h5>
                                <small> 
                                    <i class="fas fa-image mr-1"></i>
                                    Imágenes
                                </small> 
                            </a>
                        </li> 
                        <li class="list-inline-item"> 
                            <a class="custom1-link" data-bs-toggle="modal" data-bs-target="#followerModal" href="">
                                <h5 id="followsCount" class="font-weight-bold mb-0 d-block">
                                    @if ($follows == null)
                                        0
                                    @else
                                        {{$follows->count()}}
                                    @endif
                                </h5>
                                <small> 
                                    <i class="fas fa-user mr-1"></i>
                                    Seguidores
                                </small> 
                            </a>
                        </li> 
                        <li class="list-inline-item"> 
                            <a class="custom1-link" data-bs-toggle="modal" data-bs-target="#memberModal" href="">
                                <h5 class="font-weight-bold mb-0 d-block">
                                    @if ($members == null)
                                        0
                                    @else
                                        {{count($members)}}
                                    @endif
                                </h5>
                                <small> 
                                    <i class="fas fa-users mr-1"></i>
                                    Miembros
                                </small> 
                            </a>
                        </li> 
                    </ul> 
                </div> 
                <div class="px-4 py-1"> 
                    <div class="d-flex justify-content-around">
                        <p class="mb-0">
                            <h5>
                                <a class="custom-link" role="button" data-bs-toggle="collapse" data-bs-target="#info-data" aria-expanded="false" aria-controls="info-data">
                                    Información
                                </a>
                            </h5>
                        </p>
                        <p class="mb-0">
                            <h5>
                                <a class="custom-link" role="button" data-bs-toggle="collapse" data-bs-target="#about-data" aria-expanded="false" aria-controls="about-data">
                                    Nosotros
                                </a>
                            </h5>
                        </p>
                        <p class="mb-0">
                            <h5>
                                <a class="custom-link" role="button" data-bs-toggle="collapse" data-bs-target="#neg-data" aria-expanded="false" aria-controls="neg-data">
                                    Negocios
                                </a>
                            </h5>
                        </p>
                        <p class="mb-0">
                            <h5>
                                <a class="custom-link" role="button" data-bs-toggle="collapse" data-bs-target="#rel-data" aria-expanded="false" aria-controls="rel-data">
                                    Relaciones
                                </a>
                            </h5>
                        </p>
                    </div>
                    <div class="collapse" id="info-data">
                        <div class="col p-4 rounded bg-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
                            <p class="mb-0"><span class="text-secondary">Sociedad Comercial: </span>{{$company->society}}</p> 
                            <p class="mb-0"><span class="text-secondary">Sector Económico: </span>{{$company->sector}}</p> 
                            <p class="mb-0"><span class="text-secondary">Propiedad: </span>{{$company->property}}</p> 
                            <p class="mb-0"><span class="text-secondary">Propietario: </span>{{$owner->name}}</p> 
                        </div> 
                    </div>
                    <div class="collapse" id="about-data">
                        <div class="col p-4 rounded bg-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
                            <p class="mb-0"><span class="text-secondary">{{$company->description}}</span></p> 
                        </div> 
                    </div>
                    <div class="collapse" id="neg-data">
                        <div class="col p-4 rounded bg-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            @if (!empty($brands) && count($brands) > 0) 
                                <div class="container">
                                    <div class="row g-2">
                                        @foreach ($brands as $br)
                                            <div class="col-6">
                                                <a href="{{route('brand.edit', $br->br_id)}}" class="text-dark" style="text-decoration: none;">
                                                    <img src="{{$br->image != null ? Storage::disk('s3')->url('brands_pics/'.$br->image) : asset('storage/user_img.png')}}" class="img-fluid rounded-circle float-left" alt="" width="45" height="45">
                                                    <p style="font-size: 1.2vw;">{{$br->pro_name}}</p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p class="mb-0"><h3 class="text-center">No tienes Negocios</h3></p> 
                            @endif 
                        </div> 
                    </div>
                    <div class="collapse" id="rel-data">
                        <div class="col p-4 rounded bg-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
                            @if (!empty($contacts1))
                                <div class="container">
                                    <div class="row g-2">
                                        @foreach ($contacts1 as $cont)
                                            <div class="col-6">
                                                <a href="{{route('company.show', $cont->com_id)}}" class="text-dark" style="text-decoration: none;">
                                                    <img src="{{Storage::disk('s3')->url('companies_pics/'.$cont->com_image)}}" class="img-fluid rounded-circle float-left" alt="" width="60" height="60">
                                                    <p style="font-size: 1.2vw;">{{$cont->com_name}} <small class="text-muted" style="font-size: 0.7vw;"> {{$cont->location}} <i class="fas fa-map-marker-alt mr-2"></i></small></p>
                                                    <small class="text-muted">{{date_format(new DateTime($cont->created_at), 'F d Y - h:m a')}}</small>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p class="mb-0"><h4 class="text-center">No tiene Relaciones</h4></p> 
                            @endif  
                        </div> 
                    </div>
                </div> 
                <div class="py-2 px-0"> 
                    <div class="d-flex align-items-center justify-content-between mb-3 px-4"> 
                        <h5 class="mb-0">Publicaciones recientes</h5>
                    </div> 
                    <div class="card">
                        <div class="card-body" style="overflow-y:auto; height:50vh;">
                            @if ($posts != null)
                                @foreach ($posts as $pts)
                                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                        <div class="card-header">
                                            <small class="float-right pe-none">{{date_format(new DateTime($pts->updated_at), 'F d Y - h:m a')}}</small>
                                            <p style="padding: 0; margin: 0;"><small>Publicado por <a class="custom-link" href="{{route('profesional.show', $pts->id)}}">{{$pts->name}}</a>    -   {{$pts->career}}</small></p>
                                        </div>
                                        <div class="card-body">
                                            <p>{{$pts->description}}</p>
                                            @if ($pts->image != null)
                                                <img src="{{Storage::disk('s3')->url('posts_pics/'.$pts->image)}}" class="img-fluid" alt="" width="100%" height="300" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
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
</div>



<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imágenes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($posts != null)
                    @if ($posts->where('image', '<>', null)->count() == 0)
                        <h4 class="text-center">No tiene imagenes</h4>
                    @else
                        <div class="container">
                            <div class="row g-2">
                                @foreach ($posts as $img)
                                    @if ($img->image != null)
                                        <div class="col-sm-6">
                                            <img width="100%" src="{{Storage::disk('s3')->url('posts_pics/'.$img->image)}}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <h4 class="text-center">No tiene imagenes</h4>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="followerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seguidores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($follows == null)
                    <h4 class="text-center">No tiene seguidores</h4>
                @else
                    @foreach ($follows as $flw)
                        <a href="{{route('profesional.show', $flw->id)}}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-start">
                                <div class="align-self-start">
                                    <img class="rounded-circle" src="{{$flw->image != null ? Storage::disk('s3')->url('profesionals_pics/'.$flw->image) : asset('storage/user_img.png')}}" width="70px">
                                </div>
                                <div class="align-self-center">
                                    <h4>{{$flw->name}}</h4>
                                    <p class="text-muted">{{$flw->career}}</p>
                                </div>
                            </div>
                        </a>         
                    @endforeach
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Miembros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($members == null)
                    <h4 class="text-center">No tiene miembros</h4>
                @else
                    <div class="list-group">
                        @foreach ($members as $mb)
                            <a href="{{route('profesional.show', $mb->id)}}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-start">
                                    <div class="align-self-start">
                                        <img class="rounded-circle" src="{{$mb->image != null ? Storage::disk('s3')->url('profesionals_pics/'.$mb->image) : asset('storage/user_img.png')}}"  width="70px">
                                    </div>
                                    <div class="align-self-center">
                                        <h4>{{$mb->name}}</h4>
                                        <p class="text-muted">{{$mb->career}}</p>
                                    </div>
                                </div>
                            </a>                   
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@include('inc.likeable')