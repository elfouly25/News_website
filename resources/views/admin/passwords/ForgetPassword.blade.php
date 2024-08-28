@extends('layouts.admin')

@section('title', 'Forgot Password')

@section('content')
    <div class="form-container">
        <h1>Forgot Password</h1>

        @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.request') }}" class="form-content">
            @csrf <!-- Blade directive for generating a CSRF token -->

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
            </div>
        </form>
    </div>
@endsection

<!-- Inline Styles -->
<style>
    .form-container {
        max-width: 400px;
        margin: 100px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-content {
        padding: 0;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left; /* Aligns the form fields to the left */
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

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>
