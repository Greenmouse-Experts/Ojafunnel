@extends('layouts.frontend')
@section('page-content')
<!-- Contact-us Ends -->
    <section class="cont-welcome">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="text">
                        <h1>
                            Confirm Unsubscribe
                        </h1>
                        <p>
                        Are you sure you want to unsubscribe?
                        </p>
                    </div>
                    <div class="mount">

                        <a href="{{route('index')}}">
                            <button>
                                Cancel
                            </button>
                        </a>
                        <a href="#" onclick="triggerUnsubscribeForm()" style="text-decoration: none;">
                            <button style="background-color: #527EEB; color: #fff;">
                                Unsubscribe
                            </button>
                        </a>
                        <form id="unsubscribeForm" method="POST" action="{{ route('unsubscribe.confirm') }}" style="display: none;">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
<!-- Contact-us Ends -->
<script>
    function triggerUnsubscribeForm() {
        // Trigger the form submission when the button is clicked
        document.getElementById('unsubscribeForm').submit();
    }
</script>
@endsection
