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
                  <li><a class="dropdown-item" href="{{ route('chat.practicingLearnedWords') }}">Tanult szavak gyakorlása</a></li>
                  <li><a class="dropdown-item" href="{{ route('chat.readingFromLearnedWords') }}">Tanult szavakból olvasmány</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ route('chat.practicingUnknownWords') }}">Ismeretlen szavak gyakorlása</a></li>
                </ul>
              </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Szótár
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="{{ route('chat.createNewDictionary') }}">Új szótár létrehozása</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Kérdés gyakorlás
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="{{ route('chat.answersToQuestions') }}">Kérdésekre válaszolás</a></li>
                  <li><a class="dropdown-item" href="{{ route('chat.askingQuestion') }}">Kérdés feltevés</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-color" aria-current="page" href="{{ route('chat.sentenceCheck') }}">Mondat ellenőrzés és javítás</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-color" href="{{ route('chat.phraseLearning') }}">Kifejezések tanulása</a>
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
