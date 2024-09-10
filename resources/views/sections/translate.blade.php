@extends('admin.dashboard.dashboard-layout')

@section('title', 'Translate Section')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto; height: 100vh; overflow-y: auto;">
        <div class="row">
            <!-- Translations Table Section -->
            <div class="col-lg-12">
                <div class="bg-white shadow-sm rounded p-4 mb-4">
                    <h2 class="mb-4">Existing Translations</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($translations as $translation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $translation->title }}</td>
                                    <td>{{ $translation->languageCode }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="editTranslation('{{ $translation->languageCode }}', '{{ $translation->title }}')">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Translation Form Section -->
            <div class="col-lg-12">
                <div class="bg-white shadow-sm rounded p-4 mb-4">
                    <h1 class="mb-4">Edit Translations</h1>

                    <!-- Update Section Form -->
                    <form action="{{ route('sections.translate.store', $section->id) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Title:</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}" class="form-control" placeholder="Enter section title">
                            @error('title')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="languageCode">Language</label>
                            <select id="languageCode" name="languageCode" class="form-control">
                                <option value="">Select Language</option>
                                <option value="ar">Arabic</option>
                                <option value="sp">Spanish</option>
                                <option value="fr">French</option>
                                <!-- Add more languages as needed -->
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                Update Section
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editTranslation(lang, title) {
        var langInput = document.getElementById('languageCode');
        var titleInput = document.getElementById('title');
        langInput.value = lang;
        titleInput.value = title;
    }
</script>
@endpush