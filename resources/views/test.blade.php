    <!--Bostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>


<style>.navbar-nav .nav-link{
    color: #fff;
  }
  .dropend .dropdown-toggle{
    color: salmon;
    margin-left: 5em;
  }
  .dropdown-item:hover{
    background-color: lightsalmon;
    color: #fff;
  }
  .dropdown .dropdown-menu{
    display: none;
  }
  .dropdown:hover > .dropdown-menu, .dropend:hover > .dropdown-menu{
    display: block;
    margin-top: .125em;
    margin-left: .125em;
  }
  @media screen and (min-width:769px) {
    .dropend:hover > .dropdown-menu{
      position: absolute;
      top: 0;
      left: 100%;
    }
    .dropend .dropdown-toggle{
      margin-left: .5em;
    }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="{{ route('chat.practicingLearnedWords') }}">Tanult szavak gyakorlása</a></li>
                <li><a class="dropdown-item" href="{{ route('chat.practicingUnknownWords') }}">Ismeretlen szavak gyakorlása</a></li>

                <li class="nav-item dropend">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Tanult szavak gyakorlása
                </a>
                    <ul class="dropdown-menu">
                    <li class="nav-item dropend">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </li>


            </ul>

          </li>



</nav>
