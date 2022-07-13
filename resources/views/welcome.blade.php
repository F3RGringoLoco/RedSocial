@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="background-color: #28282B; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="card-body">
                    <div class="title">
                        <h3 class="texto-bienvenida">CHOLAAAAA!</h3>
                    </div>
                    <div class="text-properties">
                        <div id="text-slide">Potencia</div> 
                        <div id="text-slide"> 
                            <span>tu negocio hoy mismo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="d-grid gap-2 col-6 mx-auto">
        <a class="btn btn-lg btn-outline-dark" type="button" href="{{route('post.index')}}"><h3>Explorar</h3></a>
    </div>
    <hr><br>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card border-light mb-3" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="card-header">
                    Registrate
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-user-plus fa-8x" style="color:#202A44;"></i>
                    </div>
                    <br>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-light mb-3" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="card-header">
                    Crea tu perfil de Negocio
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-address-card fa-8x" style="color:#202A44;"></i>
                    </div>
                    <br>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-light mb-3" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="card-header">
                    Crea tu red de Contactos
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-network-wired fa-8x" style="color:#202A44;"></i>
                    </div>
                    <br>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

