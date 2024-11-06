<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- styles -->
  <link href="{{asset('selecao/css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{asset('selecao/css/bootstrap-responsive.css')}}" rel="stylesheet">
  <link href="{{asset('selecao/css/prettyPhoto.css')}}" rel="stylesheet">
  <link href="{{asset('selecao/font/stylesheet.css')}}" rel="stylesheet">
  <link href="{{asset('selecao/css/animate.css')}}" rel="stylesheet">
  <link href="{{asset('selecao/css/flexslider.css')}}" rel="stylesheet">
  <link rel="stylesheet" media="screen" href="{{asset('selecao/css/sequencejs.css')}}">
  <link href="{{asset('selecao/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('selecao/color/default.css')}}" rel="stylesheet">


  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="{{asset('selecao/ico/apple-touch-icon-144-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="{{asset('selecao/ico/apple-touch-icon-114-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="{{asset('selecao/ico/apple-touch-icon-72-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" href="{{asset('selecao/ico/apple-touch-icon-57-precomposed.png')}}">
  <link rel="shortcut icon" href="{{asset('selecao/ico/favicon.ico')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .navbar {
      background-color: black;
    }
  </style>

  <style>
    .truncate-cell {
      max-width: 200px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 80%;
    }

    .center2 {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 100%;
    }

    .nav-link {
      color: white
    }

    .back {
      margin-left: 85px;
    }
  </style>

</head>

<body>
  <header>

    <!-- start top -->
    <div id="" class="navbar navbar-fixed-top default">
      <div class="navbar-inner">
        <div class="container">
          <div class="logo">
            <a class="brand" href="index.html"><img src="img/logo.png" alt=""></a>
          </div>
          <div class="navigation">
            <nav>
              <ul class="nav pull-left">
                <li><a href="/">Barchasi</a></li>

                @foreach ($models as $model)
          @if ($model->is_active == 1)
        <li><a href="{{ route('posts.by.category', $model->id) }}">{{$model->name}}</a></li>

      @endif

        @endforeach
                @if (auth()->check() && auth()->user()->role == 'admin')
          <li><a href="/category">Admin Page</a></li>
        @endif

                <li><a href="/poll_Index">So'rovnomalar</a></li>

              </ul>

              <ul class="nav pull-right">
                @if (auth()->check())
          <li>
            <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="nav-link">
              Logout
            </button>
            </form>
          </li>
        @else
      <li><a href="/login">Login</a></li>
      <li><a href="/register">Register</a></li>
    @endif



              </ul>
            </nav>
          </div>
          <!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <!-- end top -->
  </header>

  <!-- section featured -->

  <div class="container mt-3">
    <div class="row">
      <div class="col-12">
        @yield('content')

      </div>
    </div>
  </div>

  <footer>
    <div class="verybottom">
      <div class="container">
        <div class="row">
          <div class="span12">
            <div class="aligncenter">
              <div class="logo">
                <a class="brand" href="index.html">
                  <img src="img/logo.png" alt="">
                </a>
              </div>
              <p>Lorem ipsum dolor sit amet, solet saepe vim an, te vim facer facilis docendi</p>
              <div class="social-links">
                <ul class="social-links">
                  <li><a href="#" title="Twitter"><i class="icon-circled icon-64 icon-twitter"></i></a></li>
                  <li><a href="#" title="Facebook"><i class="icon-circled icon-64 icon-facebook"></i></a></li>
                  <li><a href="#" title="Google plus"><i class="icon-circled icon-64 icon-google-plus"></i></a></li>
                  <li><a href="#" title="Linkedin"><i class="icon-circled icon-64 icon-linkedin"></i></a></li>
                  <li><a href="#" title="Pinterest"><i class="icon-circled icon-64 icon-pinterest"></i></a></li>
                </ul>

              </div>

              <p>
                &copy; Selecao - All right reserved
              </p>
              <div class="credits">
                <!--
                  All the links in the footer should remain intact.
                  You can delete the links only if you purchased the pro version.
                  Licensing information: https://bootstrapmade.com/license/
                  Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Selecao
                -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Javascript Library Files -->
  <script src="{{asset('selecao/js/jquery.min.js')}}"></script>
  <script src="{{asset('selecao/js/jquery.easing.js')}}"></script>
  <script src="{{asset('selecao/js/bootstrap.js')}}"></script>
  <script src="{{asset('selecao/js/jquery.lettering.js')}}"></script>
  <script src="{{asset('selecao/js/parallax/jquery.parallax-1.1.3.js')}}"></script>
  <script src="{{asset('selecao/js/nagging-menu.js')}}"></script>
  <script src="{{asset('selecao/js/sequence.jquery-min.js')}}"></script>
  <script src="{{asset('selecao/js/sequencejs-options.sliding-horizontal-parallax.js')}}"></script>
  <script src="{{asset('selecao/js/portfolio/jquery.quicksand.js')}}"></script>
  <script src="{{asset('selecao/js/portfolio/setting.js')}}"></script>
  <script src="{{asset('selecao/js/jquery.scrollTo.js')}}"></script>
  <script src="{{asset('selecao/js/jquery.nav.js')}}"></script>
  <script src="{{asset('selecao/js/modernizr.custom.js')}}"></script>
  <script src="{{asset('selecao/js/prettyPhoto/jquery.prettyPhoto.js')}}"></script>
  <script src="{{asset('selecao/js/prettyPhoto/setting.js')}}"></script>
  <script src="{{asset('selecao/js/jquery.flexslider.js')}}"></script>

  <!-- Contact Form JavaScript File -->
  <script src="{{asset('selecao/contactform/contactform.js')}}"></script>

  <!-- Template Custom Javascript File -->
  <script src="{{asset('selecao/js/custom.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>