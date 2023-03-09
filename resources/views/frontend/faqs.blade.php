@extends('layouts.frontend')
@section('page-content')
    <!-- faq-welcome Ends -->
        <section class="faq-welcome">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text">
                            <h1>
                                Frequently Asked Questions
                            </h1>
                            <p>
                                Do you have questions and need answers, lets help.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- faq-welcome Ends -->

    <!-- Ferent -->
        <section class="Ferent">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-lg-4">
                        <div class="btn-area">
                            <div class="tagged">
                                <h1>
                                    Categories
                                </h1>
                            </div>
                            <div class="expand">
                                <div class="cate">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingNine">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                                                General
                                            </button>
                                            </h2>
                                            <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cate">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTen">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="" aria-expanded="false" aria-controls="">
                                                Getting Started
                                            </button>
                                            </h2>
                                            <div id="flush-headingTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cate">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTen">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="" aria-expanded="false" aria-controls="">
                                                Account Management
                                            </button>
                                            </h2>
                                            <div id="flush-headingTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cate">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTen">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="" aria-expanded="false" aria-controls="">
                                                Campaign Management
                                            </button>
                                            </h2>
                                            <div id="flush-headingTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cate">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTen">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="" aria-expanded="false" aria-controls="">
                                                Contact Management
                                            </button>
                                            </h2>
                                            <div id="flush-headingTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cate">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTen">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="" aria-expanded="false" aria-controls="">
                                                SMS
                                            </button>
                                            </h2>
                                            <div id="flush-headingTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cate">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTen">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="" aria-expanded="false" aria-controls="">
                                                Security & Privacy
                                            </button>
                                            </h2>
                                            <div id="flush-headingTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    @foreach(App\Models\Faq::get() as $faq)
                    <div class="col-lg-4">
                        <div class="accord">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingEight">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{$faq->id}}" aria-expanded="false" aria-controls="flush-{{$faq->id}}">
                                        Q : {{$faq->question}}
                                    </button>
                                    </h2>
                                    <div id="flush-{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            {{$faq->answer}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    <!-- Ferent Ends -->

    <!-- Digital -->
        <section class="digital">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mount">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <h1>
                                        Are you ready to take your digital marketing to the next level!
                                    </h1>
                                    <div class="level"></div>
                                    <a href="signup">
                                <button>
                                    Sign up
                                </button>
                            </a>
                            <a href="{{route('demo')}}">
                                <button style="background-color: #527EEB; color: #fff;">
                                    See Demo
                                </button>
                            </a>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Digital Ends -->
@endsection
