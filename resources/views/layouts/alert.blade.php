@if($errors->any())
    @foreach($errors->all() as $error)
    <div class="col-12 mb-2">
        <div class="alert alert-danger alert-timeout alert-border-left alert-timeout fade show" role="alert">
            <!-- <i class="mdi mdi-block-helper me-3 align-middle"></i> -->
            {{$error}}!
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>
    @endforeach
@endif

@if(session()->has('type'))
<div class="col-12 mb-2">
    <div class="alert alert-{{session()->get('type')}} alert-timeout alert-border-left fade show" role="alert">
        <!-- <i class="bi bi-{{session()->get('icon')}} me-3 align-middle"></i> -->
        {{session()->get('message')}}
        <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
    </div>
</div>
@endif