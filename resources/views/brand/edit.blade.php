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
                            <h5 class="font-weight-bold mb-0 d-block"><i class="far fa-check-circle"></i></h5>
                            <small class="text-muted"> 
                                Verified
                            </small> 
                        </li> 
                    </ul> 
                </div>
                <div class="px-4 py-1"> 
                    
                    <div>
                        <div class="col p-4 rounded bg-light" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
                            <p class="mb-0"><span class="text-secondary">{{$brand->description}}</span></p> 
                        </div> 
                    </div>
                </div> 
            </div> 
        </div>
        
    </div>
</div>
@endsection