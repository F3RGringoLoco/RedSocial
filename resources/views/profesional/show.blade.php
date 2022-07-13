@extends('layouts.app')

@section('content')
<div class="container">

    @include('inc.sidenavs')

    <div class="row justify-content-center">        
        <div class="col-md-8 mx-auto"> <!-- Profile widget --> 
            <div class="bg-white shadow rounded overflow-hidden"> 
                <div class="px-4 pt-0 pb-4 cover" style="background-image: url(https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940);"> 
                    <div class="media align-items-end profile-head"> 
                        <div class="profile mr-3">
                            <img src="{{Storage::disk('s3')->url('profesionals_pics/'.$profesional->image)}}" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                            <div class="profile mr-3">
                                <h6 id="followProBtn" class="px-3" style="text-align: center;display: inline-block;cursor: pointer; color:{{$profesional->followed ? '#761F17' : '#202A44' }}" onclick="followProfesional({{$profesional->id}})">Seguir <i class="fas fa-heart"></i></h6>
                            </div>
                        </div> 
                        <div class="media-body mb-5 text-white"> 
                            <h4 class="mt-0 mb-0">{{$profesional->name}}, {{\Carbon\Carbon::now()->diffInYears($profesional->birth)}}</h4> 
                            <p class="small mb-4"> 
                                <i class="fas fa-user-graduate mr-2"></i>
                                {{$profesional->career}}
                            </p> 
                        </div> 
                    </div> 
                </div> 
                <div class="bg-light p-4 d-flex justify-content-end text-center"> 
                    <ul class="list-inline mb-0"> 
                        <li class="list-inline-item"> 
                            <a class="custom1-link" data-bs-toggle="modal" data-bs-target="#followerModal" href="">
                                <h5 class="font-weight-bold mb-0 d-block">
                                    @if ($followers->isEmpty())
                                        0
                                    @else
                                        {{$followers->count()}}
                                    @endif
                                </h5>
                                <small> 
                                    <i class="fas fa-user mr-1"></i>
                                    Seguidores
                                </small> 
                            </a>
                        </li> 
                        <li class="list-inline-item"> 
                            <a class="custom1-link" data-bs-toggle="modal" data-bs-target="#followingModal" href="">
                                <h5 class="font-weight-bold mb-0 d-block">
                                    @if ($following->isEmpty())
                                        0
                                    @else
                                        {{$following->count()}}
                                    @endif
                                </h5>
                                <small> 
                                    <i class="fas fa-user mr-1"></i>
                                    Sigue
                                </small> 
                            </a> 
                        </li>
                    </ul> 
                </div> 
                <div class="px-4 py-3"> 
                    <h5 class="mb-0">Información Personal</h5>
                    <div class="p-4 rounded shadow-sm bg-light"> 
                        <div class="d-flex justify-content-around">
                            <p class="mb-0">{{$email[0]}}</p> 
                            <p class="mb-0">{{$profesional->phone}}</p> 
                        </div>
                    </div> 
                </div> 
                <div class="py-2 px-0"> 
                    <div class="d-flex align-items-center justify-content-between mb-3 px-4"> 
                        <h5 class="mb-0">Mis Publicaciones</h5>
                    </div> 
                    <div class="card">
                        <div class="card-body" style="overflow-y:auto; height:40vh;">
                            @if ($posts != null)
                                @foreach ($posts as $pts)
                                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                        <div class="card-header">
                                            <small class="float-right pe-none">{{date_format(new DateTime($pts->updated_at), 'F d Y - h:m a')}}</small>
                                            <a href="{{route('company.show', $pts->com_id)}}" class="text-dark" style="text-decoration: none;">
                                                <img src="{{Storage::disk('s3')->url('companies_pics/'.$pts->com_image)}}" class="img-fluid rounded-circle float-left" alt="" width="50" height="50">
                                                <span style="font-size: 25px; font-weight: bold;">{{$pts->com_name}}</span>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p>{{$pts->description}}</p>
                                            @if ($pts->image != '')
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



<div class="modal fade" id="followerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seguidores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($followers->isEmpty())
                    <h4 class="text-center">No tiene seguidores</h4>
                @else
                    @foreach ($followers as $follower)
                        <a href="{{route('profesional.show', $follower->id)}}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-start">
                                <div class="align-self-start">
                                    <img class="rounded-circle" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/488320/profile/profile-80.jpg">
                                </div>
                                <div class="align-self-center">
                                    <h4>{{$follower->name}}</h4>
                                    <p class="text-muted">{{$follower->career}}</p>
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


<div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sigue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($following->isEmpty())
                    <h4 class="text-center">No sigue a nadie</h4>
                @else
                    @foreach ($following as $follow)
                        <a href="{{route('profesional.show', $follow->id)}}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-start">
                                <div class="align-self-start">
                                    <img class="rounded-circle" src="{{$follow->image != null ? Storage::disk('s3')->url('profesionals_pics/'.$follow->image) : asset('storage/user_img.png')}}" width="70px">
                                </div>
                                <div class="align-self-center">
                                    <h4>{{$follow->name}}</h4>
                                    <p class="text-muted">{{$follow->career}}</p>
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
@endsection

@include('inc.likeable')