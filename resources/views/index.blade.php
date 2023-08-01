@extends('layouts.app')
@section('content')
        <div class="row">
            <div class="col text-center mt-6">
                <div class="text">Learning using a new approach</div>
            </div>
        </div>

        <div class="row" style="margin-top: 120px">
            <div class="col-12 col-md-6 col-lg-4 mt-4">
                <div class="container custom-container d-flex justify-content-center align-items-center float-right">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        <label>Szó kincs fejlesztés</label>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Tanult szavak gyakorlása</a></li>
                        <li><a class="dropdown-item" href="#">Tanult szavakból olvasmány</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Ismeretlen szavak gyakorlása</a></li>
                    </ul>
                  </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4">
                <div class="container custom-container d-flex justify-content-center align-items-center">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        <label>Szótár</label>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Új szótár létrehozása</a></li>
                    </ul>
                  </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4 ">
                <div class="container custom-container d-flex justify-content-center align-items-center float-left">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        <label>Kérdés gyakorlás</label>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Kérdésekre válaszolás</a></li>
                        <li><a class="dropdown-item" href="#">Kérdés feltevés</a></li>
                    </ul>
                  </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mt-4 text-center">
                <div class="container custom-container d-flex justify-content-center align-items-center float-right">
                    <label>Mondat ellenőrzés és javítás</label>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mt-4 text-center">
                <div class="container custom-container d-flex justify-content-center align-items-center">
                    <label>Kifejezések tanulása</label>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mt-4 mb-6 text-center">
                <div class="container custom-container d-flex justify-content-center align-items-center float-left">
                    <label>infó</label>
                </div>
            </div>
        </div>



@endsection
