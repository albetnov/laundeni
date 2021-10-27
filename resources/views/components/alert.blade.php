@if (session()->has('pesan'))
    <div class="alert alert-{{ session('tipe') }}">{{ session('pesan') }}</div>
@endif
