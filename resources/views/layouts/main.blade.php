<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="app.css" rel="stylesheet" >
    <!-- <link rel="icon" type="image/png" href="/favicon.png"/> -->
    <!-- <script src="app.js"> </script> -->
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #222;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">LMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-light">

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/">Home</a>
          </li>

           <!--Change To ONLY !Session::has('client') -->
            @if ( Session::has('client') || !Session::has('client') )
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Administrators
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      @if ( Session::has('admin') )
                          <li><a class="dropdown-item" href="/admin_panel">Admin Panel</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="/admin_logout">Log Out</a></li>
                      @else
                          <li><a class="dropdown-item" href="/admin_login">Log In</a></li>
                          <li><a class="dropdown-item" href="/admin_register">Register</a></li>
                      @endif
                  </ul>
              </li>
            @endif

            <!--Change To ONLY !Session::has('admin') -->
             @if( Session::has('admin') || !Session::has('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Client
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if ( Session::has('client') )
                            <li><a class="dropdown-item" href="/client_home">Client Home</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/client_logout">Log Out</a></li>
                        @else
                            <li><a class="dropdown-item" href="/client_login">Log In</a></li>
                        @endif
                    </ul>
                </li>
              @endif
        
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" id="search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
    </div>
  </div>
</nav>



<section class="content">
<div class="container m-5">
    @yield('content')
</div>
</section>


  <footer>
    <p>
      LMS <span id="copyright">COPYRIGHT &copy; <?php echo date('Y'); ?></span>
    </p> 
  </footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="app.js"></script>
</body>
</html>