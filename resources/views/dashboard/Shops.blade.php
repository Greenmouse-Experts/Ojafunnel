@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Shops</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Shops</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">Shops</h4>
                            <p>
                                Set Up Your Own Shop
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($store->count() > 0)
                    @foreach($store as $item)
                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="row">
                                    <div class="col-xl-5">
                                        <div class="text-center p-4 border-end">
                                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                    {{$item->name[0]}}
                                                </span>
                                            </div>
                                            <h5 class="text-truncate pb-1">{{$item->name}}</h5>
                                        </div>
                                    </div>

                                    <div class="col-xl-7">
                                        <div class="p-4 text-center text-xl-start">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div>
                                                        <p class="text-muted mb-2 text-truncate">Products Available</p>
                                                        <h5>112</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <a href="{{route('user.stores.link', $item->name)}}" class="text-decoration-underline text-reset">See Profile <i class="mdi mdi-arrow-right"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <!--  end row -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
>
@endsection
