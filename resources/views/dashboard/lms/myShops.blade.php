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
                            <h4 class="font-500">Shops</h4>
                            <p>
                                Set Up Your Own Shop
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($shop->count() > 0)
                    @foreach($shop as $item)
                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="row">
                                    <div class="col-xl-5">
                                        <div class="text-center p-4 border-end" style="background: #723f93; color: #fff;">
                                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                                <span class="avatar-title rounded-circle bg-white bg-soft text-primary font-size-16">
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
                                                        <p class="text-muted mb-2 text-truncate">Courses Available</p>
                                                        {{\App\Models\Course::where('user_id', Auth::user()->id)->get()->count()}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <a href="{{route('user.shops.link', $item->name)}}" class="text-decoration-underline text-reset">Visit Shop <i class="mdi mdi-arrow-right"></i></a>
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
@endsection
