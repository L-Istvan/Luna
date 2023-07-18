@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/chat.css') }}">

<div class="card-body">

    <div id="container">
        {{ $alma }}
    </div>
</div>


<script src="{{ asset('js/chat.js') }}"></script>

@endsection
