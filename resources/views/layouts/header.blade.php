<style>
.invisible-button {
    background: none;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    color:white;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #1A1A1B">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img class="logo" src="{{ asset('images/Logo.ico') }}"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-color" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Szó kincs fejlesztés
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="{{ route('reading.selectionPageIndex') }}">Szavakból olvasmány</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li class="nav-item dropend">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
              </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Szótár
                </a>
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
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link nav-color" aria-current="page" href="{{ route('question.index') }}">Kérdés gyakorlás</a>

            </li>
            <li class="nav-item">
                <a class="nav-link nav-color" aria-current="page" href="{{ route('sentenceCheck.index') }}">Mondat ellenőrzés és javítás</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('chat.phraseLearning') }}"><i>Kifejezések tanulása</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-color" href="">infó</a>
            </li>
        </ul>
            @if (Auth::check())
                <a class="nav-link nav-color" style="margin-right:10px">{{Auth::user()->email}}</a>
                <a class="nav-link nav-color" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kijelentkezés</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif

            @if (Auth::check() === false)
            <div class="d-flex flex-column flex-md-row text-right">
                <a class="nav-link nav-color" href="{{ route('login') }}" style="margin-right: 10px">Bejelentkezés</a>
                <a class="nav-link nav-color" href="{{ route('register') }}">Regisztráció</a>
            </div>
            @endif
      </div>
    </div>
  </nav>


  <!--------- modal -------->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Szótár létrehozás</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <label id="error"></label>
            @error('modalInput')
                <div class="alert alert-danger">{{ $message }}</div>
             @enderror
            <div class="d-flex justify-content-start">
                <input id="modalInput" type="text" name="modalInput" placeholder="Tábla neve">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success" onclick="submitModalInput()">Mentés</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Mégse</button>
            </div>
        </div>
      </div>
    </div>
  </div>


