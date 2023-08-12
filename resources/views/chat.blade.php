@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/chat.css') }}">

<div class="card-body">

    <div id="container">
        <div class="AI">1
            <div class="d-flex align-items-baseline mb-4">
                <div class="position-relative avatar">
                    <img src={{asset("images/favicon.ico")}}
                     class="img-fluid rounded-circle" alt="">
                </div>
                <div class="pe-2">
                    <div class="card card-text d-inline-block p-2 px-3 m-1"> {{ $chatGPT_text }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/chat.js') }}"></script>

@endsection
