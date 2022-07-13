<div class="container-fluid">

    <div class="sidenav-left">
        <ul class="list-group list-group-flush">
            @if (Auth::check())
                    <a href="#" class="list-group-item list-group-item-action disabled">
                        <img src="https://d2qp0siotla746.cloudfront.net/img/use-cases/profile-picture/template_0.jpg" class="img-fluid rounded-circle float-left" alt="" width="35" height="35">
                        <h3>Menu</h3>
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


    <div class="sidenav-right">
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small>And some small print.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
            </a>
        </div>
    </div>
</div>