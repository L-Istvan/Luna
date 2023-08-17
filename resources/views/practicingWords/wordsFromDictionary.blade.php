@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/chat.css') }}">

<div class="card-body">
    <div id="container">
        <div id="dictionaryName" data-name="{{ $dictionaryName }}"></div>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="input d-flex flex-column align-items-center" style="margin-bottom: 70px;">
        <div class="d-flex flex-sm-row flex-column">
            <button id="changeButton" class="rounded ml-sm-2" style="color: white; background-color: rgb(26, 52, 71); border-color: rgb(90, 156, 204); margin-right:10px">
                <span id="buttonText"><i>Válts magyar kérdésekre</i></span>
            </button>
            <button class="rounded ml-sm-2" id="AIHelp" style="color: white; background-color: rgb(26, 52, 71); border-color: rgb(90, 156, 204);">
                <i>Nem jut eszembe, próbálj segíteni</i>
            </button>
        </div>
    </div>
</div>


<script src="{{ asset('js/practicingWords.js') }}" type="module"></script>


@endsection
