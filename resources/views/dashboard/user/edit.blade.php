@extends('layouts.main')
<style>
    select {
        padding-right: 25px;
        /* Tambahkan padding untuk anak panah */
    }

    select:after {
        content: "";
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        border-width: 0 5px 5px 0;
        border-color: transparent transparent black transparent;
        pointer-events: none;
    }
</style>
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="back m-2 mb-0">
                <a href="/dashboard/data-user" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <div class="card-header pb-0">
                <h4 class="text-capitalize text-center">Edit User <span class="text-uppercase">{{ $user->username }}</span></h4>
            </div>
            <form method="POST" action="{{ route('dashboard.data-user.edit', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Nama Lengkap</label>
                                <input value="{{ old('name', $user->name)}}" class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-control-label">Username</label>
                                <input value="{{ old('username', $user->username) }}" class="form-control @error('username') is-invalid @enderror" type="text" id="username" name="username">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-password-input" class="form-control-label">Password</label>
                                <div class="input-group">
                                    <input class="form-control @error('password')is-invalid @enderror" type="password" id="example-password-input" name="password">
                                    <button class="badge bg-primary border-none" type="button" id="togglePassword">
                                        <i type="button" class="fa fa-eye"></i>
                                    </button>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select" class="form-control-label">Role</label>
                                <select class="form-control" id="example-select" name="role">
                                    <option value="{{$user->role}}">{{ $user->role }}</option>
                                    @if($user->role=='user')
                                    <option value="admin">Admin</option>
                                    @else
                                    <option value="user">User</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                    </div>
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('example-password-input');
        var passwordIcon = document.querySelector('#togglePassword i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });
</script>
@endsection