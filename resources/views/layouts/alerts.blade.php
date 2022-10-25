@if($errors->any())
    @foreach($errors->all() as $error)
    <div class="col-12 mb-2">
        <div class="alert alert-danger alert-timeout alert-dismissible fade show" role="alert">
            {{$error}}!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endforeach
@endif

@if(session()->has('type'))
<div class="col-12 mb-2">
    <div class="alert alert-{{session()->get('type')}} alert-timeout alert-dismissible fade show" role="alert">
        {{session()->get('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif