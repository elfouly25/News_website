@extends('layouts.app')

@section('title', 'Sections')

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
        <h1>Sections</h1>
        <a href="{{ route('sections.create') }}" style="
            padding: 12px 24px;
            background-color: rgb(39, 39, 121);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 16px;
        ">Add New Section</a>

        @foreach($sections as $section)
            <div style="
                margin-bottom: 24px;
                background-color: #ffffff;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                padding: 16px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            ">
                <h2 style="margin: 0;">{{ $section->title }}</h2>
                <div>
                    <a href="{{ route('sections.edit', $section->id) }}" style="
                        padding: 8px 16px;
                        background-color: #007bff;
                        color: white;
                        border: none;
                        border-radius: 4px;
                        text-decoration: none;
                        margin-right: 8px;
                    ">Edit</a>

                    <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="
                            padding: 8px 16px;
                            background-color: #dc3545;
                            color: white;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;
                        ">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
