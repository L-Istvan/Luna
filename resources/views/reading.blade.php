@extends('layouts.app')
@section('content')


<div class="card-body">

    <div class="text-center text-slate-900 mb-4 mt-6" style="color: rgb(200, 202, 207);">
        <h5>ELmentett szavakból olvasmány generálása</h5>
    </div>
    <div>
        <a class="nav-link dropdown-toggle text-center " style="color: rgb(98, 170, 222);" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <form id="myForm" action="{{ route('reading.generateTextFromSavedWords') }}" method="POST"  class="form-inline">
                @csrf
                <div class="form-group mx-sm-3 mb-2">
                <select name="dropdown" onchange="submitForm()" class="rounded" style="color:rgb(3, 3, 3); background-color: rgb(80, 141, 184); border-color: rgb(90, 156, 204)">
                    <option value="" disabled selected hidden>Szótár választás</option>
                    @foreach ($tableNames as $tableName)
                        <option value="{{ $tableName }}">{{ $tableName }}</option>
                    @endforeach
                </select>
                </div>
            </form>
        </a>
    </div>

    <div class="text-center mb-4 mt-6" style="color: rgb(200, 202, 207);">
        <h5>Egyénileg hozzá adott szavakból olvasmány generálása</h5>
    </div>

    <form action="{{ route('reading.show') }}" method="get">
        <div class="text-center">
            <button type="submit" class="rounded" style="color:rgb(3, 3, 3); background-color: rgb(80, 141, 184); border-color: rgb(90, 156, 204)">Szavak hozzáadása</button>
        </div>
    </form>
</div>

<script>
    function submitForm() {
      document.getElementById("myForm").submit();
    }
  </script>

@endsection
