<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('index.html') }}">
            Start Bootstrap
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index.html') }}">HOME</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">ABOUT</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">SAMPLE POST</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">CONTACT</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-warning fw-bold" href="{{ route('formindex') }}">
                        📝 My Blogs
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-danger ms-3">Logout</button>
                    </form>
                </li>

            </ul>
        </div>

    </div>
</nav>
