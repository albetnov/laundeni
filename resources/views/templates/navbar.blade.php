<nav class="navbar navbar-expand-md navbar-light bg-light shadow p-2 mb-3 rounded">
    <div class="container">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
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
                            href="{{ route('admin.pengguna') }}" {!! strpos(Route::currentRouteName(), 'admin.pengguna') === 0 ? 'aria-current="page"' : '' !!}>
                            Data Pengguna
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'admin.pelanggan.index') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.pelanggan.index') === 0 ? 'active' : '' }}"
                            href="{{ route('admin.pelanggan.index') }}" {!! strpos(Route::currentRouteName(), 'admin.pelanggan.index') === 0 ? 'aria-current="page"' : '' !!}>
                            Pelanggan
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'admin.outlet') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.outlet') === 0 ? 'active' : '' }}"
                            href="{{ route('admin.outlet') }}" {!! strpos(Route::currentRouteName(), 'admin.outlet') === 0 ? 'aria-current="page"' : '' !!}>
                            Outlet
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'admin.paket') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.paket') === 0 ? 'active' : '' }}"
                            href="{{ route('admin.paket') }}" {!! strpos(Route::currentRouteName(), 'admin.paket') === 0 ? 'aria-current="page"' : '' !!}>
                            Paket
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'admin.transaksi.index') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.transaksi.index') === 0 ? 'active' : '' }}"
                            href="{{ route('admin.transaksi.index') }}" {!! strpos(Route::currentRouteName(), 'admin.transaksi.index') === 0 ? 'aria-current="page"' : '' !!}>
                            Transaksi
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'admin.laporan') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.laporan') === 0 ? 'active' : '' }}"
                            href="{{ route('admin.laporan') }}" {!! strpos(Route::currentRouteName(), 'admin.laporan') === 0 ? 'aria-current="page"' : '' !!}>
                            Laporan
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'owner')
                    <li class="nav-item active">
                        <a class="nav-link active" href="{{ route('owner.dashboard') }}">Home <span
                                class="visually-hidden">(current)</span></a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'owner.laporan') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'owner.laporan') === 0 ? 'active' : '' }}"
                            href="{{ route('owner.laporan') }}" {!! strpos(Route::currentRouteName(), 'owner.laporan') === 0 ? 'aria-current="page"' : '' !!}>
                            Laporan
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'kasir')
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'kasir.dashboard') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'kasir.dashboard') === 0 ? 'active' : '' }}"
                            href="{{ route('kasir.dashboard') }}" {!! strpos(Route::currentRouteName(), 'kasir.dashboard') === 0 ? 'aria-current="page"' : '' !!}>
                            Home
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'kasir.pelanggan.index') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'kasir.pelanggan.index') === 0 ? 'active' : '' }}"
                            href="{{ route('kasir.pelanggan.index') }}" {!! strpos(Route::currentRouteName(), 'kasir.pelanggan.index') === 0 ? 'aria-current="page"' : '' !!}>
                            Pelanggan
                        </a>
                    </li>
                    <li
                        class="nav-item {{ strpos(Route::currentRouteName(), 'kasir.transaksi.index') === 0 ? 'active' : '' }}">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'kasir.transaksi.index') === 0 ? 'active' : '' }}"
                            href="{{ route('kasir.transaksi.index') }}" {!! strpos(Route::currentRouteName(), 'kasir.transaksi.index') === 0 ? 'aria-current="page"' : '' !!}>
                            Transaksi
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'disabled')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('newuser.dashboard') }}">Home <span
                                class="visually-hidden">(current)</span></a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
