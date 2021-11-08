@extends('templates.panel')
@section('title', 'Dashboard')
@section('content')
    <x-card>
        <x-slot name="header">
            Welcome, {{ Auth::user()->name }}!
        </x-slot>
        <h3>Manage Akun</h3>
        <form method="POST" action="#">
            @csrf
            <div class="form-group mb-1">
                <input type="text" name="username" class="form-control" placeholder="Your username...">
            </div>
            <div class="form-group mb-1">
                <input type="text" name="name" class="form-control" placeholder="Your name...">
            </div>
        </form>
        <x-slot name="footer">
            <button class="btn btn-sm btn-primary"><i class="fas fa-pen"></i> Edit Account</button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#changePass">
                <i class="fas fa-user-edit"></i> Change Password
            </button>

            <!-- Modal -->
            <div class="modal fade" id="changePass" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="#">
                                @csrf
                                <div class="form-group mb-1">
                                    <input type="password" name="newpass" class="form-control" placeholder="New Password">
                                </div>
                                <div class="form-group mb-1">
                                    <input type="password" name="conpass" class="form-control"
                                        placeholder="Confirm New Password">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-card>
@endsection
