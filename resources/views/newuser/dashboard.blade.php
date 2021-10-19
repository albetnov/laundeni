@extends('templates.panel')
@section('title', 'Dashboard | New User')
@section('content')
    <x-card>
        <x-slot name="header">
            Welcome, {{ Auth::user()->name }}!
        </x-slot>
        <p>Saat ini akun anda sedang menunggu persetujuan admin.</p>
        <x-slot name="footer">
            <form style="display:inline" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-success"><i class="fas fa-sign-out-alt"></i>Logout</button>
            </form>
        </x-slot>
    </x-card>
@endsection
