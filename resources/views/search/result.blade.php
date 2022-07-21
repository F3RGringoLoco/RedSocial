@extends('layouts.app')

@section('content')
<div class="container">

    @include('inc.sidenavs')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Resultado') }}</div>
                <div class="card-body" style="overflow-y:auto; height:80vh;">
                    <div class="list-group list-group-flush">
                        @if (count($comp) > 0)
                            <a href="#" class="list-group-item list-group-item-action disabled" aria-current="true">
                                <div class="d-flex w-100">
                                <h5 class="mb-1 text-primary">Compañias</h5>
                                </div>
                            </a>
                            @foreach ($comp as $cmp)
                                <a href="{{route('company.show', $cmp->com_id)}}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <img class="img-fluid rounded-circle float-left" src="{{$cmp->com_image != null ? Storage::disk('s3')->url('companies_pics/'.$cmp->com_image) : asset('storage/user_img.png')}}" alt="" width="40" height="40">
                                            <h5 class="mb-1" style="white-space: nowrap;">{{$cmp->com_name}}</h5>
                                        </div>
                                        <div>
                                            <small class="text-muted">{{$cmp->created_at}}</small>
                                        </div>
                                    </div>
                                    <p class="mb-1">{{$cmp->description}}</p>
                                </a>
                            @endforeach
                        @endif
                        @if (count($prof) > 0)
                            <a href="#" class="list-group-item list-group-item-action disabled" aria-current="true">
                                <div class="d-flex w-100">
                                <h5 class="mb-1 text-primary">Profesionales</h5>
                                </div>
                            </a>
                            @foreach ($prof as $pr)
                                <a href="{{route('profesional.show', $pr->id)}}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <img class="img-fluid rounded-circle float-left" src="{{$pr->image != null ? Storage::disk('s3')->url('profesionals_pics/'.$pr->image) : asset('storage/user_img.png')}}" alt="" width="40" height="40">
                                            <h5 style="white-space: nowrap;">{{$pr->name}}</h5>
                                        </div>
                                        <small class="text-muted">Edad : {{\Carbon\Carbon::now()->diffInYears($pr->birth)}}</small>
                                    </div>
                                    <p class="mb-1 ">{{$pr->career}}</p>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection