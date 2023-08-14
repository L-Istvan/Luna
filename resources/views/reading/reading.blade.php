@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/chat.css') }}">

<div class="card-body">
    <div id="dictionaryName" style="display: none;" data-name="{{ $dictionaryName }}"></div>
    <div id="container">
        <div class="AI" id="AI">
            <div class="d-flex align-items-baseline mb-4">
                <div class="position-relative avatar">
                    <img src={{asset("images/favicon.ico")}}
                     class="img-fluid rounded-circle" alt="">
                </div>
                <div class="pe-2">
                    <div id="chatGTP_text" class="card card-text d-inline-block p-2 px-3 m-1"> {{ $chatGPT_text }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="input d-flex flex-column align-items-center" style="margin-bottom: 70px;">
        <div class="d-flex flex-sm-row flex-column">
            <button id="generateMoreText" class="rounded ml-sm-2" style="color: white; background-color: rgb(26, 52, 71); border-color: rgb(90, 156, 204); margin-right:10px; display:none">
                <span id="buttonText"><i>Írj még történetet</i></span>
            </button>
            <button class="rounded ml-sm-2" id="translateText" style="color: white; background-color: rgb(26, 52, 71); border-color: rgb(90, 156, 204);">
                <i>Fordítsd magyar nyelvre</i>
            </button>
        </div>
    </div>
</div>

<script src="{{ asset('js/reading.js') }}" type="module"></script>
@endsection
