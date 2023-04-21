@extends('layouts.frontend')
@section('page-content')
<div class="template-hero-banner">
    <div class="container h-100">
        <div class="hero-container">
            <div class="template-hero-div">
                <p class="template-head-text">Free Page Builder Templates</p>
                <p class="template-mid-text">Choose a template and get started</p>
                <div class="template-search-div">
                    <input type="search" placeholder="Search template" />
                    <i class="bi bi-search"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hero ends -->
<!-- page contents -->
<div class="template-content">
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-2 pe-lg-5 template-side">
                <div class="license-div">
                    <p><i class="bi bi-check2-square pe-2 text-warning fs-4"></i>License</p>
                    <ul class="license-radio">
                        <li>
                            <input type="radio" name="license" />
                            <span>Any</span>
                        </li>
                        <li>
                            <input type="radio" name="license" />
                            <span>Free</span>
                        </li>
                        <li>
                            <input type="radio" name="license" />
                            <span>Premium</span>
                        </li>
                    </ul>
                </div>
                <div class="sort-div">
                    <p><i class="bi bi-sort-down fs-4 pe-2 text-warning"></i>Sort by</p>
                    <ul class="sort-radio">
                        <li>
                            <input type="radio" name="sort" />
                            <span>Recent</span>
                        </li>
                        <li>
                            <input type="radio" name="sort" />
                            <span>Popular</span>
                        </li>
                        <li>
                            <input type="radio" name="sort" />
                            <span>Top Rated</span>
                        </li>
                        <li>
                            <input type="radio" name="sort" />
                            <span>Editor's Pick</span>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="col-lg-12">
                <!-- category -->
                <!-- <div class="choose-category">
                    <p>Choose Category</p>
                    <div class="category-list">
                        <ul>
                            <li class="bg-success text-white">Eccommerce</li>
                            <li class="bg-warning text-white">Easter</li>
                            <li class="bg-primary text-white">Business</li>
                            <li class="bg-danger text-white">Finance</li>
                            <li class="bg-info text-white">Crypto</li>
                            <li class="bg-secondary text-white">Logistics</li>
                            <li class="bg-success text-white">Eccommerce</li>
                            <li class="bg-warning text-white">Easter</li>
                            <li class="bg-primary text-white">Business</li>
                            <li class="bg-danger text-white">Finance</li>
                            <li class="bg-info text-white">Crypto</li>
                            <li class="bg-secondary text-white">Logistics</li>
                        </ul>
                    </div>
                </div> -->
                <!-- category content -->
                <div class="template-listing">
                    <div class="template-listing-grid">
                        <div class="single-template">
                            <div class="inner first-grid">
                                <div class="text-center">
                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                    <a href="{{route('signup')}}" class="btn btn-primary d-block mt-2">New Template</a>
                                </div>
                            </div>
                        </div>
                        @foreach(App\Models\Page::latest()->where('published', true)->get() as $page)
                        <div class="single-template">
                            <div class="inner second-grid">
                                @if($page->thumbnail)
                                <img src="{{$page->thumbnail}}" alt="templates" width="100%" height="100%" />
                                @else
                                <img src="http://via.placeholder.com/640x1000" alt="templates" width="100%" height="100%" />
                                @endif
                                <div class="start-template">
                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                    <a href="{{route('templateDetails', Crypt::encrypt($page->id))}}" class="btn btn-primary d-block mt-2">Use Template</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page contents ends -->
@endsection