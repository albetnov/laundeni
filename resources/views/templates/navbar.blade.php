<nav class="navbar navbar-expand-md navbar-light bg-light shadow p-2 mb-3 rounded">
    <div class="container">
        <a class="navbar-brand" href="#">Laudeni</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                        <a class="dropdown-item" href="#">Action 2</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
