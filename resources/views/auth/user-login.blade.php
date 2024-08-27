@extends('layouts.app')
@section('title', 'Login Page')
@section('content')
    <div class="login-form">
    <h1>Login</h1>

    <form method="POST" action="{{ route('UserLogin') }}">
        @csrf <!-- Blade directive for generating a CSRF token -->

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <!-- Forgot Password Link -->
        <div class="form-group">
            <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
@endsection

<style>
    /* Basic styling for the login form */
    .login-form {
        max-width: 400px;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .forgot-password {
        display: block;
        margin-top: 10px;
        font-size: 0.9em;
        color: #007bff;
        text-decoration: underline; /* Ensure text is underlined */
    }

    .forgot-password:hover {
        text-decoration: underline; /* Keep underline on hover */
        color: #0056b3;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }
</style>
