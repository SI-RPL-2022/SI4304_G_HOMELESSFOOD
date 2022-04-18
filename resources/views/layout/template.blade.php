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
              <a class="nav-link" href="/select_food">Pilih Makanan Donasi</a>
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
                  <a class="dropdown-item" href="/dashboard">Dashboard</a>
                  
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="proses/logout.php">Logout</a>
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

	@yield('content')


 <hr class="featurette-divider">

  <!-- FOOTER -->
  <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2021. OkeDoc, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
</html>
