@extends('admin.dashboard.dashboard-layout')

@section('title', 'Create Sub-Admin')

@section('content')
    <h1>Create Sub-Admin Account</h1>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" required>
                <div class="input-group-append">
                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">Show</button>
                </div>
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                <div class="input-group-append">
                    <button type="button" id="togglePasswordConfirmation" class="btn btn-outline-secondary">Show</button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Sub-Admin</button>
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