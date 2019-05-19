<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    @isset($user)
    <button class="btn btn-primary" id="menu-toggle">Menu</button>
    @endisset
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
       
        @empty($user)
        <li class="nav-item active">
        <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item active">
        <a class="nav-link" href="/register">Daftar</a>
        </li>
        @endempty
        @isset($user)
        <li class="nav-item active">
        <a class="nav-link text-primary" href="/">Halo, {{$user->nrp}}! <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
        <a class="nav-link" href="/logout">Logout</a>
        </li>
        @endisset
    </ul>
    </div>
</nav>