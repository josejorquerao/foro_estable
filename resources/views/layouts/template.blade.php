<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="{{ asset('js/app.js') }}" defer></script>
<head>
  @include('plugins')
  <title>Conexion-Salud</title>
</head>
<body>
  <div>
    <div>
      <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#fcfcfc">
        <div class="collapse navbar-collapse">      
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            @if (Auth::user())
             <a class="navbar-brand" href="{{ url('/home') }}" style="color:grey">Conexion-Salud</a>        
            @else
             <a class="navbar-brand" href="{{ url('/login') }}" style="color:grey">Conexion-Salud</a>
            @endif
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}" style="color:#02709d">{{ __('Entrar') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}" style="color:#02709d">{{ __('Crear cuenta') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#02709d">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a style="color:grey" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Salir') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
            </li>
            @endguest
          </ul>
        </div>
      </nav>
    </div>

    <div class="container">
      <br>
      @yield('seccion')
    </div>

    <div>
      <footer>
        <br>
        <hr>
        <p class="text-muted text-center">Foro Conexion-Salud</p>
        <p class="text-muted text-center">Laravel v5.8</p>
      </footer>
    </div>

  </div>  
</body>
</html>