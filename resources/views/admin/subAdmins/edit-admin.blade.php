@extends('admin.dashboard.dashboard-layout')

@section('title', 'Edit Sub-Admin')

@section('content')
    <h1>Edit Sub-Admin Account</h1>

    <form action="{{ route('admin.update', $subAdmin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="Login_email">Email</label>
            <input type="email" id="Login_email" name="Login_email" class="form-control" value="{{ $subAdmin->Login_email }}" required>
            @error('Login_email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password (leave blank to keep current)</label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control">
                <div class="input-group-append">
                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">Show</button>
                </div>
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                <div class="input-group-append">
                    <button type="button" id="togglePasswordConfirmation" class="btn btn-outline-secondary">Show</button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Sub-Admin</button>
    </form>

    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', () => {
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.textContent = type === 'password' ? 'Show' : 'Hide';
            });

            const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
            const passwordConfirmationInput = document.querySelector('#password_confirmation');

            togglePasswordConfirmation.addEventListener('click', function () {
                const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmationInput.setAttribute('type', type);
                this.textContent = type === 'password' ? 'Show' : 'Hide';
            });
        });
    </script>
@endsection