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
                @if (Auth::user()->role == 'admin')
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'admin.dashboard') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.dashboard') === 0 ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}" {!! strpos(Route::currentRouteName(), 'admin.dashboard') === 0 ? 'aria-current="page"' : '' !!}>
                            Home
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'admin.pengguna') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.pengguna') === 0 ? 'active' : '' }}"
                            {!! strpos(Route::currentRouteName(), 'admin.dashboard') === 0 ? 'aria-current="page"' : '' !!}>
                            Data Pengguna
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'admin.pelanggan') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.pelanggan') === 0 ? 'active' : '' }}"
                            href="#" {!! strpos(Route::currentRouteName(), 'admin.pelanggan') === 0 ? 'aria-current="page"' : '' !!}>
                            Pelanggan
                        </a>
                    </li>
                    <div class="nav-item">
                        <a class="nav-link" href="#">Outlet</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="#">Paket</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="#">Transaksi</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="#">Laporan</a>
                    </div>
                @elseif(Auth::user()->role == 'owner')
                    <li class="nav-item active">
                        <a class="nav-link active" href="{{ route('owner.dashboard') }}">Home <span
                                class="visually-hidden">(current)</span></a>
                    </li>
                    <div class="nav-item">
                        <a class="nav-link" href="#">Laporan</a>
                    </div>
                @elseif (Auth::user()->role == 'kasir')
                    <li class="nav-item active">
                        <a class="nav-link active" href="{{ route('kasir.dashboard') }}">Home <span
                                class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pelanggan</a>
                    </li>
                    <div class="nav-item">
                        <a class="nav-link" href="#">Transaksi</a>
                    </div>
                @elseif(Auth::user()->role == 'disabled')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('newuser.dashboard') }}">Home <span
                                class="visually-hidden">(current)</span></a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Aksi</a>
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
