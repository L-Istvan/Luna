<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1A1A1B">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img class="logo" src="images/Logo.ico"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Szó kincs fejlesztés
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Tanult szavak gyakorlása</a></li>
                  <li><a class="dropdown-item" href="#">Tanult szavakból olvasmány</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Ismeretlen szavak gyakorlása</a></li>
                </ul>
              </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Szótár
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Új szótár létrehozása</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Kérdés gyakorlás
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Kérdésekre válaszolás</a></li>
                  <li><a class="dropdown-item" href="#">Kérdés feltevés</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-color" aria-current="page" href="#">Mondat ellenőrzés és javítás</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-color" href="#">Kifejezések tanulása</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-color" href="#">infó</a>
            </li>
        </ul>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            @if (Auth::check())
                {{Auth::user()->email}}
                <button type="submit" id="logout">Kijelentkezés</button>
                <button type="submit" id="logout"></button>
            @endif
        </form>
        <form class="d-flex flex-column flex-md-row" action="" method="POST">
            @csrf
            @if (Auth::check() === false)
            <div class="d-flex flex-column flex-md-row text-right">
                <button class="auth mx-2 mb-2 mb-md-0" id="login">Bejelentkezés</button>
                <button class="auth mx-2" type="button" id="regist">Regisztráció</button>
            </div>
            @endif
        </form>
      </div>
    </div>
  </nav>
