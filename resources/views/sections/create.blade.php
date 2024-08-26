@extends('layouts.app')

@section('title', 'Create Section')

@section('content')
    <div style="
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        padding: 24px;
    ">
        <h1 style="
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 16px;
            text-align: left;
        ">
            Create New Section
        </h1>

        <form action="{{ route('sections.store') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 16px;">
                <label for="title" style="
                    font-weight: bold;
                    display: block;
                    margin-bottom: 8px;
                ">Section:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" style="
                    width: 95%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                ">
                @error('title')
                    <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="
                padding: 12px 24px;
                background-color: rgb(39, 39, 121);
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
                display: block;
                margin-top: 16px;
            ">
                Create Section
            </button>
        </form>
    </div>
@endsection
