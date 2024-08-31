@extends('layouts.admin')

@section('title', 'Login')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/login_style.css') }}">

    <div class="login-container">
        <h1>Admin Login</h1>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="login-form">
            @csrf
            
            <div class="form-group">
                <label for="Login_email">Login</label>
                <input type="email" id="Login_email" name="Login_email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" class="form-control" required>
                    <button type="button" id="togglePassword" class="toggle-password-btn">Show</button>
                </div>
            </div>

            <!-- Forgot Password Link -->
            <div class="form-group">
                <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
            </div>            
            
            <!-- Submit Button -->
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.textContent = type === 'password' ? 'Show' : 'Hide';
            });
        });
    </script>
@endsection