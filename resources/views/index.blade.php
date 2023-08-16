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
                        <li><a class="dropdown-item" href="{{ route('reading.selectionPageIndex') }}">Szavakból olvasmány</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="nav-item dropend">
                            <a class="nav-link dropdown-toggle" style="margin-left: 15px"  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tanult szavak gyakorlása
                            </a>
                              <ul class="dropdown-menu dropdown-menu-dark">
                              <li class="nav-item dropend">
                                  @if(! auth()->check())
                                      <a class="dropdown-item" href="{{ route('login') }}">
                                          Szótár használathához be kell jelentkezned
                                      </a>
                                  @elseif ( $tableNames === 0 )
                                      <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#myModal">
                                          Nincsen még szótárod, hozz létre egyet
                                      </a>
                                  @else
                                      @foreach ($tableNames as $name)
                                          <li>
                                              <a class="dropdown-item" href="{{ route('practicingWords.index',$name) }}">
                                                  {{ $name }} szótár
                                              </a>
                                          </li>
                                      @endforeach
                                  @endif
                              </ul>
                          </li>
                        <li><a class="dropdown-item" href="{{ route('practicingUnknownWords.index') }}">Ismeretlen szavak gyakorlása</a></li>
                    </ul>
                  </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4">
                <div class="container custom-container d-flex justify-content-center align-items-center">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        <label>Szótár</label>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        @if(! auth()->check())
                            <a class="dropdown-item" href="{{ route('login') }}">
                                Szótár használathához be kell jelentkezni
                            </a>
                        @elseif ( $tableNames === 0 )
                            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#myModal">
                                Nincsen még szótárod, hozz létre egyet
                            </a>
                        @else
                            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#myModal">
                                Új szótár létrehozás
                            </a>
                            @foreach ($tableNames as $name)
                                <li><a class="dropdown-item" href="{{ route('dictionary.edit',$name) }}">{{ $name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                  </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4 ">
                <div class="container custom-container d-flex justify-content-center align-items-center float-left">
                    <a style="color: white; text-decoration: none;" href="{{ route('question.index') }}">Kérdés gyakorlás</a>
                  </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mt-4 text-center">
                <div class="container custom-container d-flex justify-content-center align-items-center float-right">
                    <a style="color: white; text-decoration: none;" href="{{ route('sentenceCheck.index') }}">Mondat ellenőrzés és javítás</a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mt-4 text-center">
                <div class="container custom-container d-flex justify-content-center align-items-center">
                    <label><i>Kifejezések tanulása</i></label>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mt-4 mb-6 text-center">
                <div class="container custom-container d-flex justify-content-center align-items-center float-left">
                    <a style="color: white; text-decoration: none;" href="{{ route('info') }}">infó</a>
                </div>
            </div>
        </div>

@endsection
