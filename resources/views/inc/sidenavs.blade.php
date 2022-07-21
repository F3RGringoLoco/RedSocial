<div class="container-fluid">

    <div class="sidenav-left">
        <ul class="list-group list-group-flush">
            @if (Auth::check())
                    <a href="#" class="list-group-item list-group-item-action disabled">
                        <img src="https://d2qp0siotla746.cloudfront.net/img/use-cases/profile-picture/template_0.jpg" class="img-fluid rounded-circle float-left" alt="" width="35" height="35">
                        <h3 class="text-primary">Menu</h3>
                    </a>
                    <a href="{{route('home')}}" class="list-group-item list-group-item-action">Inicio</a>
                    <a href="{{route('company.index')}}" class="list-group-item list-group-item-action">Mi Empresa</a>
                    <a href="{{route('post.index')}}" class="list-group-item list-group-item-action">Publicaciones</a>
                    <a href="{{route('profesional.index')}}" class="list-group-item list-group-item-action">Profesionales</a>
            @else
                    <h4 class="list-group-item list-group-item-action">Registrate para mas!</h4>
                    <a href="#" class="list-group-item list-group-item-action disabled">Inicio</a>
                    <a href="#" class="list-group-item list-group-item-action disabled">Mi Empresa</a>
                    <a href="#" class="list-group-item list-group-item-action disabled">Publicaciones</a>
                    <a href="#" class="list-group-item list-group-item-action disabled">Profesionales</a>
            @endif
        </ul>
    </div>


    @php
        $usid = strval(Auth::id());
        $recommendation = app('App\Http\Controllers\TraitsRecombeeController')->recommendations($usid);
        $recomprofile = app('App\Http\Controllers\TraitsProfController')->recommendations($usid);
    @endphp
    <div class="sidenav-right">
        <div class="list-group list-group-flush">
            @if (!empty($recommendation))
                <a href="#" class="list-group-item list-group-item-action disabled" aria-current="true">
                    <div class="d-flex w-100">
                    <h5 class="mb-1 text-primary">Publicaciones recomendadas</h5>
                    </div>
                </a>
                @foreach ($recommendation as $recom)
                    <a href="{{route('post.show', $recom->post_id)}}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$recom->com_name}}</h5>
                            <small class="text-muted">{{$recom->created_at}}</small>
                        </div>
                        <p class="mb-1">{{$recom->description}}</p>
                    </a>
                @endforeach
            @endif
            @if (!empty($recomprofile))
                <a href="#" class="list-group-item list-group-item-action disabled" aria-current="true">
                    <div class="d-flex w-100">
                    <h5 class="mb-1 text-primary">Perfiles recomendados</h5>
                    </div>
                </a>
                @foreach ($recomprofile as $recom)
                    <a href="{{route('profesional.show', $recom->id)}}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <img class="img-fluid rounded-circle float-left" src="{{$recom->image != null ? Storage::disk('s3')->url('profesionals_pics/'.$recom->image) : asset('storage/user_img.png')}}" alt="" width="40" height="40">
                                <h5 style="white-space: nowrap;">{{$recom->name}}</h5>
                            </div>
                            <small class="text-muted">Edad : {{\Carbon\Carbon::now()->diffInYears($recom->birth)}}</small>
                        </div>
                        <p class="mb-1 ">{{$recom->career}}</p>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>