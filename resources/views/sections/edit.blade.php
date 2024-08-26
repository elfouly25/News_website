@extends('layouts.app')

@section('title', 'Edit Section')

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
            margin-bottom: 12px;
            text-align: left;
        ">
            Edit Section
        </h1>

        <!-- Update Section Form -->
        <form action="{{ route('sections.update', $section->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 16px;">
                <label for="title" style="font-weight: bold;">Section:</label>
                
                <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}" style="
                    width: 90%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                ">
                @error('title')
                    <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" style="
                    padding: 12px 24px;
                    background-color: rgb(39, 39, 121);
                    color: white;
                    border: none;
                    border-radius: 4px;
                    font-size: 16px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                ">
                    Update Section
                </button>
            </div>
        </form>

        <!-- Delete Section Form -->
        <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="margin-top: 16px;">
            @csrf
            @method('DELETE')
            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" style="
                    padding: 12px 24px; 
                    background-color: #e53e3e;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    font-size: 16px;    
                    cursor: pointer;
                    transition: background-color 0.3s;
                ">
                    Delete Section
                </button>
            </div>
        </form>
    </div>
@endsection
