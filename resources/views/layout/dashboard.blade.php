<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Homless Food</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/carousel.css" rel="stylesheet">
    <script src="/assets/js/jquery.js"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body>
    <header>
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-white">
    <a class="navbar-brand" href="/">
      <b>Homeless Food</b>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home <span class="sr-only">(current)</span></a>
        </li>

        @if(session()->has('user'))
          @if(session()->get('user')->akses == 'user')
            <li class="nav-item">
              <a class="nav-link" href="cari.php">Pilih Makanan Donasi</a>
            </li>
          @endif
        @endif
        
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        @if(session()->has('user'))
            <ul style=" list-style-type: none;">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{session()->get('user')->nama}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                  <a class="dropdown-item" href="/profile">Profil</a>
                  
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/auth/do_logout">Logout</a>
                </div>
              </li>
            </ul>

        @else
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link mr-3" href="/auth/register">Daftar disini</a>
              </li>
            </ul>
            <a href="/auth/login" class="btn btn-warning my-2 my-sm-0 text-white" type="submit">Login</a>
        @endif

      </form>
    </div>
  </nav>
</header>

<main role="main">
    <div id="myCarousel" class="slide bg-warning" data-ride="carousel" style="height: 80px">
      <div class="container mt-3">
        <br>
        <h3 class="text-white">@yield('title')</h3>
      </div>
    </div>

    <div class="container mt-4 mb-4">
      <div class="row">
        <div class="col-3">
          <a href="/dashboard" style="text-decoration: none">
            <div class="card {{ Route::currentRouteName() == 'dashboard' ? 'bg-warning' : '' }}">
              <div class="card-body p-2">
                <b class="{{ Route::currentRouteName() == 'dashboard' ? 'text-white' : '' }}">
                  <img src="/gambar/007-dashboard.png" style="width: 50px"> Dashboard
                </b>
              </div>
            </div>
          </a>
        </div>

        <div class="col-3">
          @if(session()->get('user')->akses == 'admin')
            <a href="/food" style="text-decoration: none">
              <div class="card {{ Route::currentRouteName() == 'food' ? 'bg-warning' : '' }}">
                <div class="card-body p-2">
                  <b class="{{ Route::currentRouteName() == 'food' ? 'text-white' : '' }}">
                    <img src="/gambar/001-diet.png" style="width: 50px"> Makanan</b>
                </div>
              </div>
            </a>

          @elseif(session()->get('user')->akses == 'user')
            <a href="/homeless" style="text-decoration: none">
              <div class="card {{ Route::currentRouteName() == 'homeless' ? 'bg-warning' : '' }}">
                <div class="card-body p-2">
                  <b class="{{ Route::currentRouteName() == 'homeless' ? 'text-white' : '' }}">
                    <img src="/gambar/001-diet.png" style="width: 50px"> Tunawisma</b>
                </div>
              </div>
            </a>

          @endif
        </div>

        <div class="col-3">
          <a href="/profile" style="text-decoration: none">
            <div class="card {{ Route::currentRouteName() == 'transaction' ? 'bg-warning' : '' }}">
              <div class="card-body p-2">
                <b class="{{ Route::currentRouteName() == 'transaction' ? 'text-white' : '' }}">
                  <img src="/gambar/006-payment-method.png" style="width: 50px"> Transaksi</b>
              </div>
            </div>
          </a>
        </div>

        <div class="col-3">
          <a href="/profile" style="text-decoration: none">
            <div class="card {{ Route::currentRouteName() == 'profile' ? 'bg-warning' : '' }}">
              <div class="card-body p-2">
                <b class="{{ Route::currentRouteName() == 'profile' ? 'text-white' : '' }}">
                  <img src="/gambar/008-girl.png" style="width: 50px"> Profil</b>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

	 @yield('content')


 <hr class="featurette-divider">

  <!-- FOOTER -->
  <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2021. OkeDoc, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
</html>
