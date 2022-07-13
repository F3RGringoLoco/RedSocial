@extends('layouts.app')

@section('content')
<div class="container">

    @include('inc.sidenavs')

    <div class="row justify-content-center">   
        
        <div class="col-md-8 mx-auto"> <!-- Profile widget --> 
            <div class="bg-white shadow rounded overflow-hidden"> 
                <!--<div class="px-4 pt-0 pb-4 cover" style="background-image: url(https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940);"> -->
                <div class="px-4 pt-0 pb-4 cover" style="background-image: url({{asset('storage/default_cover.jpeg')}});">
                    <div class="media align-items-end profile-head"> 
                        <div class="profile mr-3">
                            <img src="{{$brand->image != null ? Storage::disk('s3')->url('brands_pics/'.$brand->image) : asset('storage/user_img.png')}}" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                            <div class="dropdown">
                                <button class="btn btn btn-outline-dark btn-sm btn-block dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{route('company.index')}}"><i class="fas fa-angle-double-left"></i> Volver</a></li>
                                    <li>
                                        <form action="{{ route('brand.destroy', $brand->br_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div> 
                        <div class="media-body mb-5 text-white"> 
                            <h4 class="fw-bolder mt-0 mb-0">{{$brand->pro_name}}</h4>
                            <p class="fw-bold small mb-4">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{$brand->location}}
                            </p> 
                        </div> 
                    </div> 
                </div> 
                <div class="bg-light p-4 d-flex justify-content-end text-center"> 
                    <ul class="list-inline mb-0"> 
                        <li class="list-inline-item"> 
                            <h5 class="font-weight-bold mb-0 d-block">215</h5>
                            <small class="text-muted"> 
                                <i class="fas fa-image mr-1"></i>
                                Imágenes
                            </small> 
                        </li> 
                        <li class="list-inline-item"> 
                            <h5 class="font-weight-bold mb-0 d-block">745</h5>
                            <small class="text-muted"> 
                                <i class="fas fa-user mr-1"></i>
                                Seguidores
                            </small> 
                        </li> 
                    </ul> 
                </div>
                <div class="px-4 py-1"> 
                    <div class="d-flex justify-content-around">
                        <p class="mb-0">
                            <h5>
                                <a class="custom-link" role="button" data-bs-toggle="collapse" data-bs-target="#info-data" aria-expanded="false" aria-controls="info-data">
                                    Nosotros
                                </a>
                            </h5>
                        </p>
                    </div>
                    <div class="collapse" id="info-data">
                        <div class="col p-4 rounded bg-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
                            <p class="mb-0"><span class="text-secondary">{{$brand->description}}</span></p> 
                        </div> 
                    </div>
                </div> 
                <div class="py-2 px-4"> 
                    <div class="d-flex align-items-center justify-content-between mb-3"> 
                        <h5 class="mb-0">Publicaciones relacionado</h5>
                    </div> 
                    <div class="card">
                        <div class="card-body">
                            <div class="row"> 
                                <div class="col-lg-6 mb-2 pl-lg-1">
                                    <img src="https://images.unsplash.com/photo-1469594292607-7bd90f8d3ba4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm">
                                </div> 
                                <div class="col-lg-6 mb-2 pl-lg-1">
                                    <img src="https://images.unsplash.com/photo-1493571716545-b559a19edd14?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm">
                                </div> 
                                <div class="col-lg-6 mb-2 pl-lg-1">
                                    <img src="https://images.unsplash.com/photo-1453791052107-5c843da62d97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="" class="img-fluid rounded shadow-sm">
                                </div> 
                                <div class="col-lg-6 mb-2 pl-lg-1">
                                    <img src="https://images.unsplash.com/photo-1475724017904-b712052c192a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm">
                                </div> 
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
        
    </div>
</div>
@endsection