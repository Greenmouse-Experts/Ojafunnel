@extends('layouts.admin-frontend')

@section('page-content')  
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div class="row py-3 justify-content-between align-items-center">
                        <div class="col-md-9">
                            <div class="all-create">
                                <a href="{{route('funnelBuilder')}}" style="background-color: #000; color: #fff; border: none; padding: 10px 20px 10px 20px;">
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="all-create">
                                {{-- <button data-bs-toggle="modal" data-bs-target="#template">
                                    + Create New Funnel Page
                                </button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex account-nav">
                        <p class="ps-0 active">
                            <a href="#" class="text-decoration-none text-dark">All</a>
                        </p>
                    </div>
                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- store data information-->
            
            <div class="page-contentts">
                <div class="templatee-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <!-- category content -->
                                <div class="template-listing">
                                    <div class="template-listing-grid"> 
                                        @forelse ($pages as $page)
                                            <div class="single-template">
                                                <h6 class="text-center" style="background: #556ee6; padding: 0.7rem; border-radius: 20px; color: #fff;">{{$page->name}}</h6>
                                                <div class="inner second-grid">
                                                    @if($page->thumbnail)
                                                    <img src="{{$page->thumbnail}}" alt="templates" width="100%" height="100%" />
                                                    @else
                                                    <img src="http://via.placeholder.com/640x1000" alt="templates" width="100%" height="100%" />
                                                    @endif
                                                    <div class="start-template"> 
                                                        <i class="bi bi-bookmark-plus-fill fs-1 text-primary"></i> 
                                                        <a href="
                                                            @if (env('APP_ENV') == 'local')
                                                                {{ $page->file_location }}
                                                            @else
                                                                @if ($page->name == 'index.html')
                                                                    {{ "https://$funnel->slug-funnel.ojafunnel.com"}}
                                                                @else
                                                                    {{ "https://$funnel->slug-funnel.ojafunnel.com/" . explode('.', $page->name)[0] }}
                                                                @endif 
                                                            @endif
                                                        " class="btn btn-primary d-block mt-2">
                                                            View Page
                                                        </a> 
                                                    </div>
                                                </div>
                                            </div> 
                                        @empty
                                            <div class="single-template">
                                                <div class="inner first-grid">
                                                    <div class="text-center">
                                                        <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                        {{-- <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">New Page</button> --}}
                                                        <div>
                                                            No page in this funnel yet.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection