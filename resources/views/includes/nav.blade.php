<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('home')}}">Blog Site</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
          <a class="nav-link" href="{{route('blogs')}}">Blogs</a>
            @if(session('user'))
                <a class="nav-link" href="{{route('userProfile')}}">Profile</a>
                <a class="nav-link" href="{{route('sign-out')}}">Sign Out</a>
            @else
                <a class="nav-link" href="{{route('register')}}">Register</a>
                <a class="nav-link" href="{{route('sign-in')}}">Signin</a>
            @endif
        </div>
      </div>
    </div>
  </nav>