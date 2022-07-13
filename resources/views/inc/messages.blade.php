@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="container">
            <div class="row justify-content-center">
                <div class="alert alert-danger col-8">
                    {{$error}}
                </div>
            </div>
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="alert alert-success col-8">
                {{session('success')}}
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="alert alert-danger col-8">
                {{session('error')}}
            </div>
        </div>
    </div>
@endif