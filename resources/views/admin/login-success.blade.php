<!-- resources/views/admin/login-success.blade.php -->
@extends('admin.layout')

@section('title', 'Login Successful')

@section('content')
    <div class="login-success-container">
        <h1>Login Successful</h1>
        <p>Welcome, you have successfully logged in!</p>
        <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>

    <style>
        .login-success-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(134, 70, 15, 0.1);
            text-align: center;
        }

        h1 {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0f5fb5;
        }
    </style>
@endsection
